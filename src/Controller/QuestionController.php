<?php

namespace App\Controller;

use App\Entity\Question;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="question_index", methods={"GET","POST"})
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Question::class);

        $questions = $repository->findAll();

        return $this->render('question/index.html.twig', [
            'questions' => $questions
        ]);
        return $this->render('navigation/_main_nav.html.twig', [
            'questions' => $questions
        ]);
    }

    /**
     * @Route("/question/{id}", name="question_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show($id)
    {
        return $this->render('question/index.html.twig', [
           
        ]);
    }
}
