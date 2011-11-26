<?php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Blogger\BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $c1 = new Comment();
        $c1->setAuthor('Dziamid');
        $c1->setBody('This is very nice. I like symfony coding. Symfony2 rocks');
        $c1->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($c1);

        $c2 = new Comment();
        $c2->setAuthor('Paul');
        $c2->setBody('This is very nice. I like to listen how birds sing in the morning');
        $c2->setBlog($manager->merge($this->getReference('blog-2')));
        $manager->persist($c2);

        $c3 = new Comment();
        $c3->setAuthor('Mom');
        $c3->setBody('Those bloody birds eat my food on the balcony!');
        $c3->setBlog($manager->merge($this->getReference('blog-2')));
        $manager->persist($c3);

        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }
}