<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Form\CabinetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CabinetController extends AbstractController
{
    /**
     * @Route("/cabinet", name="admin_cabinet")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $cabinets = $this->getDoctrine()
        ->getRepository(Cabinet::class)
        ->getAll();

        return $this->render('cabinet/index.html.twig', [
            'cabinets' => $cabinets,
        ]);
    }

    /**
     * @Route("/cabinet/Edit", name="admin_add_cabinet")
     * @Route("/cabinet/Edit/{id}", name="admin_edit_cabinet")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editUser(Cabinet $cabinet = null,Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if(!$cabinet)
            $cabinet = new Cabinet();

        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(CabinetType::class,$cabinet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $cabinet = $form->getData();
            $entityManager->persist($cabinet);
            $entityManager->flush();

            return $this->redirectToRoute("admin_cabinet",[
                ]);
        }

        return $this->render("cabinet/addEdit.html.twig",[
            "form" => $form->createView(),
            "users" => $cabinet,
            ]); 
    }


    /**
     * @Route("/cabinet/delete/{id}", name="admin_delete_cabinet")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteUtilisateur(Cabinet $cabinet)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->getDoctrine()->getManager();
        
        $entityManager->remove($cabinet);
        $entityManager->flush();

        return $this->redirectToRoute("admin_cabinet");
    }
}
