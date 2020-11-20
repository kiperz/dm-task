<?php

namespace App\Domain\Comments\Hydrator;

use App\Domain\Comments\DataTransferObject\AuthorDto;
use App\Domain\Comments\DataTransferObject\CommentDto;

class CommentsHydrator
{
    public function hydrateComments(array $comments): array
    {
        return array_map($this->hydratorFunc(), $comments);
    }
     private function hydratorFunc(): callable
     {
         return function(array $elem): CommentDto
         {
             return new CommentDto($elem['content'], new \DateTime($elem['created_at']), $this->hydrateAuthor($elem['author']));
         };
    }

    private function hydrateAuthor(array $author): AuthorDto
    {
        return new AuthorDto($author['email'], $author['nickname']);
    }
}