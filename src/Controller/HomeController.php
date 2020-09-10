<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Entity\Patient;
use App\Data\SearchData;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/accueil/{id}", name="home_detail")
     */
    public function index(Cabinet $cabinet = null,Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $patients = $this->getDoctrine()
                        ->getRepository(Patient::class)
                        ->getBySearch($data);
            $nav = 1;
        }
        else
        {
            if(!$cabinet)
                $nav = 1;
            else
                $nav = $cabinet->getId();

            $patients = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->getAll($data);
        }
       
        
            
        $cabinets = $this->getDoctrine()
                ->getRepository(Cabinet::class)
                ->getAll();

        return $this->render('home/index.html.twig', [
            "patients" => $patients,
            "cabinets" => $cabinets,
            "nav" => $nav,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/accueil", name="home")
     */
    public function redirectAccueil()
    {
        return $this->redirectToRoute("home_detail",[
            "id" => 0,
            ]);
        
    }
}
