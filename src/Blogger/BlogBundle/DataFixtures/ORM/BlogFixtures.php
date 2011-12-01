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
        $b = new Blog();
        $b->setAuthor('Dziamid');
        $b->setTitle('A day with Symfony2');
        $b->setImage('cammo.jpg');
        $b->setBody('Lorem ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque.');
        $b->setTags('lorem,ipsum,tag1');
        $manager->persist($b);
        $this->addReference('blog-1', $b);

        $b = new Blog();
        $b->setAuthor('Paul');
        $b->setTitle('A day building birds nest');
        $b->setImage('birds.jpg');
        $b->setBody('Lorem ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque.');
        $b->setTags('lorem,ipsum,tag2');
        $manager->persist($b);
        $this->addReference('blog-2', $b);

        $b = new Blog();
        $b->setAuthor('Danny');
        $b->setTitle('No comments blog');
        $b->setImage('no-image.jpg');
        $b->setBody('Lorem ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque. Nulla consectetur ipsum dolor sit d us imperdiet justo scelerisque.');
        $b->setTags('lorem,tag3');
        $manager->persist($b);

        $manager->flush();

    }

    public function getOrder()
    {
        return 1;
    }
}