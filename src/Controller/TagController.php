<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TagController extends AbstractController
{
    /**
     * @Route("/question/tag/{id}", name="tag_index", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function index(Tag $tags, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Question::class);

        $questions = $repository->find($id);

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tagNav = $repository->findAll();
        
        return $this->render('tag/index.html.twig', [
            'questions' => $questions,
            'tags' => $tags,
            'tag' => $tagNav
        ]);
    }
}
