<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Entity\Patient;
use App\Form\PatientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PatientController extends AbstractController
{
    /**
     * @Route("/patient/{idc}", name="patient_add", defaults={"_fragment" = "consultation"})
     * @Route("/patient/{idc}/{id}", name="patient_edit", defaults={"_fragment" = "consultation"})
     */
    public function addPatient(Patient $patient = null,Request $request,$idc = null)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if(!$patient)
            $patient = new Patient();
        
        $cabinets = $this->getDoctrine()
            ->getRepository(Cabinet::class)
            ->getAll(); 

        $isIn = 0;
        if(is_numeric($idc))   
            foreach($cabinets as $c)
                if($c->getId() == $idc)
                    $isIn = 1;

        if(!$isIn)
            return $this->redirectToRoute("home_detail",[
                "id" => $idc,
                "err" => 1,
                ]);
                 
         
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(PatientType::class,$patient);
        $form->handleRequest($request);
       



        if($form->isSubmitted() && $form->isValid())
        {
            $patient = $form->getData();
            //dd($patient->getConsultations());
            $entityManager->persist($patient,$cabinets);
            $entityManager->flush();

            return $this->redirectToRoute("patient_edit",[
                "id" => $patient->getId(),
                "idc" => $idc,
                ]);
        }

        return $this->render("patient/index.html.twig",[
            "form" => $form->createView(),
            "patient" => $patient,
            "cabinets" => $cabinets,
            ]);
    }

     /**
     * @Route("/DeletePatient/{id}", name="patient_delete_full")
     * @Route("/DeletePatient/{idc}/{id}", name="patient_delete_cabinet")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deletePatient(Patient $patient,$idc = 0 )
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->getDoctrine()->getManager();
        if(!$idc)
        {
            $this->getDoctrine()
            ->getRepository(Patient::class)
            ->deletePatientById($entityManager,$patient->getId());
        }
        else
        {
            $cabinet = $this->getDoctrine()
            ->getRepository(Cabinet::class)
            ->getOneById($idc);
            $cabinet[0]->removePatient($patient);
            $entityManager->flush();
        }
        return $this->redirectToRoute("home_detail",[
            "id" => $idc,
        ]);
        
        
    }
}
