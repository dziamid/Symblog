<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     *
     * @return \Symfony\Bundle\FrameworkBundle\Controller\Response
     * @throws \Symfony\Bundle\FrameworkBundle\Controller\NotFoundHttpException
     */
    public function showAction($id, $slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->getOneWithComments($id);
        if (!$blog) {
            throw $this->createNotFoundException('Unable to find blog post');
        }
        
        return $this->render('BloggerBlogBundle:Blog:show.html.twig', array('blog' => $blog));
    }

}
