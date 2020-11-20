<?php
namespace App\Domain\Comments\Command;

use App\Infrastructure\Comments\Client\CommentsApiClient;
use App\Domain\Comments\DataTransferObject\CommentDto;

/*
 * Class CreateNewCommentCommand is responsible for creating comment in api.
 */
class CreateNewCommentCommand
{
    private CommentsApiClient $commentsApiClient;
    public function __construct(CommentsApiClient $commentsApiClient) {
        $this->commentsApiClient = $commentsApiClient;
    }

    public function execute(CommentDto $comment): void
    {
        $this->commentsApiClient->createComment($comment->toArray());
    }
}