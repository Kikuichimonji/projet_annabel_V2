<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/accueil", name="home")
     * @Route("/accueil/{id}", name="home_detail")
     */
    public function index(Cabinet $cabinet = null,Request $request)
    {

        if(!$cabinet){
            $patients = $this->getDoctrine()
                    ->getRepository(Patient::class)
                    ->getAll();
            $nav = 1;
        }
        else
        {
            $patients = $this->getDoctrine()
                ->getRepository(Patient::class)
                ->getByCabinet($cabinet);
            $nav = $cabinet->getId();
        }
            
        $cabinets = $this->getDoctrine()
                ->getRepository(Cabinet::class)
                ->getAll();

        return $this->render('home/index.html.twig', [
            "patients" => $patients,
            "cabinets" => $cabinets,
            "nav" => $nav
        ]);
    }
}
