<?php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Blogger\BlogBundle\Entity\Blog;

class BlogFixtures implements FixtureInterface
{
    public function load($manager)
    {
        $blog1 = new Blog();
        $blog1->setAuthor('Dziamid');
        $blog1->setTitle('A day with Symfony2');
        $blog1->setImage('beach.jpg');
        $blog1->setBody('Lorem ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur...');
        $manager->persist($blog1);

        $manager->flush();
    }
}