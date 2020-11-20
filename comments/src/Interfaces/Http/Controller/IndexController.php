<?php

namespace App\Interfaces\Http\Controller;

use App\Domain\Comments\Command\CreateNewCommentCommand;
use App\Domain\Comments\Query\GetCommentsListQuery;
use App\Domain\Comments\Request\CreateCommentRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController {
    /**
     * @Route("/", name="comments_index", methods={"GET"})
     */
    public function index(GetCommentsListQuery $getCommentsListQuery) {
        $comments = $getCommentsListQuery->execute();
        return $this->render('base.html.twig', ['comments' => $comments]);
    }

    /**
     * @Route("/", name="comments_index_post", methods={"POST"})
     */
    public function postComment(CreateCommentRequest $request, CreateNewCommentCommand $createNewCommentCommand) {
        $createNewCommentCommand->execute($request->toDto());
        return $this->redirect('/');
    }
}