<?php
namespace App\Domain\Comments\DataTransferObject;

class CommentDto
{
    private string $content;
    private string $nick;
    private AuthorDto $author;
    private ?\DateTime $created_at;

    public function __construct(string $content, ?\DateTime $created_at, string $nick, AuthorDto $author)
    {
        $this->content = $content;
        $this->nick = $nick;
        $this->author = $author;
        $this->created_at = $created_at;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getNick(): string
    {
        return $this->nick;
    }

    public function getAuthor(): AuthorDto
    {
        return $this->author;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function toArray(): array
    {
        return [
            "author" => $this->author->toArray(),
            "content" => $this->content,
            "nick" => $this->nick
        ];
    }
}