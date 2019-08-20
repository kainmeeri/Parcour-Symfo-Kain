<?php

namespace App\Controller;

use App\Entity\Question;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="question_index")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Question::class);

        $questions = $repository->findAll();

        return $this->render('question/index.html.twig', [
            'questions' => $questions
        ]);
    }
}
