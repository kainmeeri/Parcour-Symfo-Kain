<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Role;
use App\Entity\User;
use App\Form\AddUserType;
use App\Form\EditUserType;
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
        $user = new User();

        return $this->render('user/index.html.twig', [
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


        $role = $this->getDoctrine()->getRepository(Role::class);
        $roleuser = $role->findOneBy(array('name' => 'Utilisateur'));

        if ($formUser->isSubmitted() && $formUser->isValid()) {

            //pour encoder en mdp , je dois utiliser la methode encodePassword de l'outil UserPasswordEncoderInterface
            //cet outil va prendre le user a encoder + son nouveau mot de passe 
            $encodedPassword = $encoder->encodePassword($user, $user->getPassword());

            //je dois rentrer le mot passe encodé a la place de celui qui etait originellement en clair
            $user->setPassword($encodedPassword);

            $entityManager = $this->getDoctrine()->getManager();
            $user->setRole($roleuser);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('user/signup.html.twig', [
            'user' => $user,
            'formUser' => $formUser->createView(),
            'tags' => $tags
        ]);
    }


    /**
     * sur cette fonction je peux recuperer globalement le meme fonctionnement 
     * que sur le new, en revanche avec ce comportement laissé tel quel je vais etre bloqué des lors que je souhaite faire une modification sans vouloir changer mon mot de passe
     * 
     * Le but : recuperer l'ancien mot de passe avant l'enregistrement en BDD  pour verifier si notre utilisateur l'a laissé a null ou non
     * 
     * 
     * @Route("/account/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserPasswordEncoderInterface $encoder): Response
    {

        $user = new User();
     
        // je recupere l'ancien mot de passe 
        $oldPassword = $user->getPassword();
       
        $formEdit = $this->createForm(EditUserType::class, $user);

        //met a jour objet user avec les nouvelles valeur
        // si l'objet user n'a pas eu de nouveau mdp alors password est vide
        $formEdit->handleRequest($request);

        

        //dd($user);
        if ($formEdit->isSubmitted() && $formEdit->isValid()) {

            //si je ne souhaite pas modifier le mot de passe en edition , alors on pourrait avoir le comportement suivant : laissez vide si inchangé
            // de ce fait je dois tester si le nouveau mot de passe est vide , si c'est le cas je recupere l'ancien mot de passe
            if(is_null($user->getPassword())){

                $encodedPassword = $oldPassword;

            } else {

                $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
            }
  
            $user->setPassword($encodedPassword);
            

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $formEdit->createView(),
        ]);
    }

}
