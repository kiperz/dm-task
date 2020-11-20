<?php


namespace App\Domain\Comments\DataTransferObject;


use Symfony\Component\Validator\Constraints as Assert;

class CreateCommentDto
{
    /**
     * @Assert\NotBlank()
     */
    protected string $content;
    /**
     * @Assert\Email()
     */
    protected string $authorEmail;
    protected string $nick;

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $authorEmail
     */
    public function setAuthorEmail(string $authorEmail): void
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }

    /**
     * @param string $nick
     */
    public function setNick(string $nick): void
    {
        $this->nick = $nick;
    }

    /**
     * @return string
     */
    public function getNick(): string
    {
        return $this->nick;
    }
}