<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Votre sujet doit avoir au minimum {{ limit }} caractères",
     *      maxMessage = "Votre sujet doit avoir au maximum {{ limit }} caractères"
     * )
     */
    private $subject;
    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Votre message doit avoir au minimum {{ limit }} caractères",
     *      maxMessage = "Votre message doit avoir au maximum {{ limit }} caractères"
     * )
     */
    private $body;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getSubject(): ?string
    {
        return $this->subject;
    }
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
    public function getBody(): ?string
    {
        return $this->body;
    }
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }
}





