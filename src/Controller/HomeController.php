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
     * @Route("/accueil", name="home")
     * @Route("/accueil/{id}", name="home_detail")
     */
    public function index(Cabinet $cabinet = null,Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $cabinets = $this->getDoctrine()
            ->getRepository(Cabinet::class)
            ->getAll();
        
        if(!$cabinet)
        {
            return $this->redirectToRoute("home_detail",[
                "id" => $cabinets[0]->getId(),
                "err" => 1
                ]);
        }
        $session = $request->getSession();
        $session->set("cabinet",$cabinet);
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $patients = $this->getDoctrine()
                        ->getRepository(Patient::class)
                        ->getBySearch($data);
        }
        else
        {

            $patients = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->getAll($data);
        }
       
        

        return $this->render('home/index.html.twig', [
            "patients" => $patients,
            "cabinets" => $cabinets,
            'form' => $form->createView()
        ]);
    }

}
