<?php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('body', 'textarea')
            ->add('author')
        ;
    }

    public function getName()
    {
        return 'blogger_blogbundle_commenttype';
    }
}
