<?php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Blogger\BlogBundle\Entity\Blog;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class BlogFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $blog1 = new Blog();
        $blog1->setAuthor('Dziamid');
        $blog1->setTitle('A day with Symfony2');
        $blog1->setImage('cammo.jpg');
        $blog1->setBody('Lorem ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque.');
        $manager->persist($blog1);

        $blog2 = new Blog();
        $blog2->setAuthor('Paul');
        $blog2->setTitle('A day building birds nest');
        $blog2->setImage('birds.jpg');
        $blog2->setBody('Lorem ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque.');
        $manager->persist($blog2);

        $manager->flush();

        $this->addReference('blog-1', $blog1);
        $this->addReference('blog-2', $blog2);

    }

    public function getOrder()
    {
        return 1;
    }
}