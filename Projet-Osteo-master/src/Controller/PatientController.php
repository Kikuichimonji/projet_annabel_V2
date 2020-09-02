<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Entity\Patient;
use App\Form\PatientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PatientController extends AbstractController
{
    /**
     * @Route("/patient/{idc}", name="patient_add")
     * @Route("/patient/{idc}/{id}", name="patient_edit")
     */
    public function addPatient(Patient $patient = null,Request $request)
    {
        if(!$patient)
            $patient = new Patient();
    
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(PatientType::class,$patient);
        $form->handleRequest($request);
        $cabinets = $this->getDoctrine()
                ->getRepository(Cabinet::class)
                ->getAll();



        if($form->isSubmitted() && $form->isValid())
        {
            $patient = $form->getData();
            
            $entityManager->persist($patient,$cabinets);
            $entityManager->flush();

            return $this->redirectToRoute("patient_edit",[
                "id" => $patient->getId(),
                "idc" => 1
                ]);
        }

        return $this->render("patient/index.html.twig",[
            "form" => $form->createView(),
            "patient" => $patient,
            "cabinets" => $cabinets,
            ]);
    }
}
