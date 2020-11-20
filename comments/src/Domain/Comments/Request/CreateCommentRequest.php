<?php
namespace App\Domain\Comments\Request;

use App\Domain\Comments\DataTransferObject\AuthorDto;
use App\Domain\Comments\DataTransferObject\CommentDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CreateCommentRequest
{
    private string $content;
    private string $authorEmail;
    private string $authorNick;

    public function __construct(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();
        $this->content = $request->get('content');
        $this->authorEmail = $request->get('authorEmail');
        $this->authorNick = $request->get('authorNick');
    }

    public function toDto(): CommentDto
    {
        return new CommentDto($this->content, null, new AuthorDto($this->authorEmail, $this->authorNick));
    }
}