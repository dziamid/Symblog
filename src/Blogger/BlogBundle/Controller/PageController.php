<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class PageController extends Controller
{
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->getRepository('BloggerBlogBundle:Blog')->getLatestQB();

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb, true));
        $pager->setMaxPerPage(2);
        $request = $this->getRequest();
        $pager->setCurrentPage($request->query->get('page', 1));


        return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
            'blogs' => $pager->getIterator(),
            'pager' => $pager,
        ));
    }

    public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
        $enquiry = new Enquiry();
        $enquiry->setBody('Describe what\'s your problem');
        $form = $this->createForm(new EnquiryType(), $enquiry);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->sendContactEmail($enquiry);
                return $this->redirect($this->generateUrl('BBBundle_contact'));
            }
        }
        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function sidebarAction()
    {
        //tags
        $em = $this->getDoctrine()->getEntityManager();
        $tags = $em->getRepository('BloggerBlogBundle:Blog')->getTags();
        $weights = $em->getRepository('BloggerBlogBundle:Blog')->getTagWeights($tags);

        //comments
        $limit = $this->container->getParameter('blogger_blog.comments.latest_comment_limit');
        $comments = $em->getRepository('BloggerBlogBundle:Comment')->getLatest($limit);

        return $this->render('BloggerBlogBundle:Page:sidebar.html.twig', array(
            'tags' => $weights,
            'comments' => $comments,
        ));
    }

    protected function sendContactEmail($enquiry)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($enquiry->getSubject())
            ->setFrom($this->container->getParameter('blogger_blog.emails.contact'))
            ->setTo($enquiry->getEmail())
            ->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
        $this->get('mailer')->send($message);

        $this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

        // Redirect - This is important to prevent users re-posting
        // the form if they refresh the page
        return $this->redirect($this->generateUrl('BBBundle_contact'));
    }


}
