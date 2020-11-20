<?php
namespace App\Domain\Comments\Query;

use App\Domain\Comments\DataTransferObject\CommentDto;
use App\Infrastructure\Comments\Client\CommentsApiClient;
use App\Domain\Comments\Hydrator\CommentsHydrator;

class GetCommentsListQuery
{
    private CommentsApiClient $commentsApiClient;
    private CommentsHydrator $commentsHydrator;

    public function __construct(CommentsApiClient $commentsApiClient, CommentsHydrator $commentsHydrator) {
        $this->commentsApiClient = $commentsApiClient;
        $this->commentsHydrator = $commentsHydrator;
    }

    /**
     * @return array|CommentDto[]
     */
    public function execute(): array {
        $commentsArr = $this->commentsApiClient->getComments();

        return $this->commentsHydrator->hydrateComments($commentsArr);
    }
}