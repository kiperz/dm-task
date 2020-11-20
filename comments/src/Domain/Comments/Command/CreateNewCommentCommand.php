<?php
namespace App\Domain\Comments\Command;

use App\Domain\Comments\DataTransferObject\CreateCommentDto;
use App\Infrastructure\Comments\Client\CommentsApiClient;


/*
 * Class CreateNewCommentCommand is responsible for creating comment in api.
 */
class CreateNewCommentCommand
{
    private CommentsApiClient $commentsApiClient;
    public function __construct(CommentsApiClient $commentsApiClient) {
        $this->commentsApiClient = $commentsApiClient;
    }

    public function execute(CreateCommentDto $data): void
    {
        $authorEmail = $data->getAuthorEmail();
        $author = $this->commentsApiClient->getAuthor($authorEmail);
        if(!$author)
        {
            $author = $this->commentsApiClient->createAuthor($authorEmail);
        }

        $this->commentsApiClient->createComment($data->getContent(), $data->getNick(), $author);
    }
}