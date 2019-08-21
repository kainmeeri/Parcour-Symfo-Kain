<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Question;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $questions = $repository->findAllByOrder();

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tagsNav = $repository->findAll();

        return $this->render('question/index.html.twig', [
            'questions' => $questions,
            'tag' => $tagsNav
        ]);
    }

    /**
     * @Route("/question/{id}", name="question_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->find($id);

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tagsNav = $repository->findAll();

        return $this->render('question/show.html.twig', [
            'questions' => $questions,
            'tag' => $tagsNav
        ]);
    }


    /**
     * @Route("/new/question", name="question_new", methods={"GET","POST"})
     */
     public function new(Request $request): Response
     {
         $question = new Question();
         $form = $this->createForm(QuestionType::class, $question);
         $form->handleRequest($request);

         $repository = $this->getDoctrine()->getRepository(Tag::class);
         $tags = $repository->findAll();
 
         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($question);
             $entityManager->flush();
 
             return $this->redirectToRoute('question_index');
         }
 
         return $this->render('question/form.html.twig', [
             'questions' => $question,
             'form' => $form->createView(),
             'tags' => $tags
         ]);
     }
}
