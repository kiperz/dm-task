<?php

namespace App\Interfaces\Http\Controller;

use App\Domain\Comments\Command\CreateNewCommentCommand;
use App\Domain\Comments\Query\GetCommentsListQuery;
use App\Infrastructure\Comments\Form\CreateCommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController {
    /**
     * @Route("/", name="comments_index", methods={"GET", "POST"})
     */
    public function index(Request $request, GetCommentsListQuery $getCommentsListQuery, CreateNewCommentCommand $createNewCommentCommand) {
        $authorId = $request->get('authorId', null);
        $page = $request->get('page', 1);
        $form = $this->createForm(CreateCommentType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $createNewCommentCommand->execute($formData);
        }
        $comments = $getCommentsListQuery->execute($page, $authorId);
        return $this->render('base.html.twig', ['page' => $page, 'authorId' => $authorId, 'comments' => $comments, 'form' => $form->createView()]);
    }

}