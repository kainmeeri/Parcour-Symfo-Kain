<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\User;
use App\Form\AddUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/account", name="user_index", methods={"GET","POST"})
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tagsNav = $repository->findAll();

        $user = new User();

        return $this->render('user/index.html.twig', [
            'tag' => $tagsNav,
            'user' => $user
        ]);
    }


     /**
     *  Doc offcielle encode password : https://symfony.com/doc/current/security.html#c-encoding-passwords
     * 
     * @Route("/signup", name="app_signup", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $formUser = $this->createForm(AddUserType::class, $user);
        $formUser->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->findAll();
        $tagsNav = $repository->findAll();

        if ($formUser->isSubmitted() && $formUser->isValid()) {

            //pour encoder en mdp , je dois utiliser la methode encodePassword de l'outil UserPasswordEncoderInterface
            //cet outil va prendre le user a encoder + son nouveau mot de passe 
            $encodedPassword = $encoder->encodePassword($user, $user->getPassword());

            //je dois rentrer le mot passe encodé a la place de celui qui etait originellement en clair
            $user->setPassword($encodedPassword);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('user/signup.html.twig', [
            'user' => $user,
            'formUser' => $formUser->createView(),
            'tags' => $tags,
            'tag' => $tagsNav
        ]);
    }
}
