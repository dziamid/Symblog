<?php

namespace Blogger\BlogBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as C;

class Enquiry
{
    protected $name;

    protected $body;

    protected $email;

    protected $subject;


    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new C\NotBlank());
        $metadata->addPropertyConstraint('email', new C\Email());
        $metadata->addPropertyConstraint('subject', new C\NotBlank());
        $metadata->addPropertyConstraint('subject', new C\MaxLength(50));
        $metadata->addPropertyConstraint('body', new C\MaxLength(50));
    }
}