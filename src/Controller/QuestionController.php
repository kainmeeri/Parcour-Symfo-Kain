<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="question_index")
     */
    public function index()
    {
        return $this->render('question/index.html.twig', [
            
        ]);
    }
}