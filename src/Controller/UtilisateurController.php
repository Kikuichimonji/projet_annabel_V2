<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="admin_utilisateur")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user = $this->getDoctrine()
        ->getRepository(Utilisateur::class)
        ->getAll();

        
        return $this->render("utilisateur/index.html.twig",[
            "users" => $user,
            ]);
    }

    /**
     * @Route("/utilisateur/edit/{id}", name="admin_edit_utilisateur")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editUser(Utilisateur $user,Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(UtilisateurType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get("password")->getData()
                )
            );
            $user->setRoles( $form->get("roles")->getData());
            $user->setUsername($form->get("username")->getData());
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute("admin_utilisateur",[
                ]);
        }

        return $this->render("utilisateur/editUser.html.twig",[
            "form" => $form->createView(),
            "users" => $user,
            ]); 
    }


    /**
     * @Route("/utilisateur/delete/{id}", name="admin_delete_utilisateur")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteUtilisateur(Utilisateur $user)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->getDoctrine()->getManager();
        
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("app_login",[
            "id" => 0,
        ]);
    }
}
