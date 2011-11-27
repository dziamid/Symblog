<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Form\CommentType;

class CommentController extends Controller
{
    
    public function newAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment = new Comment();
        $comment->setBlog($blog);

        $form = $this->createForm(new CommentType(), $comment);

        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array(
            'form' => $form->createView(),
            'comment' => $comment,
        ));
    }

    public function createAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment = new Comment();
        $comment->setBlog($blog);

        $form = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($comment);
            $em->flush();
            $url = $this->generateUrl('BBBundle_blog_show', array(
                'id' => $blog->getId(),
            ));
            return $this->redirect($url.'#comment-'.$comment->getId());
        }

        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array(
            'form' => $form->createView(),
            'comment' => $comment,
        ));        
    }
    
    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if (false == ($blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blog_id))) {
            throw $this->createNotFoundException('Unable to find blog post.');
        }

        return $blog;

    }

}
