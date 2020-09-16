<?php

namespace App\Controller;


use App\Entity\ConsultCalendar;
use App\Form\ConsultCalendarType;
use App\Repository\ConsultCalendarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/agenda")
 */
class ConsultCalendarController extends AbstractController
{
    /**
     * @Route("/list", name="agenda_list", methods={"GET"})
     */
    public function index(ConsultCalendarRepository $consultCalendarRepository): Response
    {
        return $this->render('consult_calendar/index.html.twig', [
            'consult_calendars' => $consultCalendarRepository->findAll(),
        ]);
    }
    /**
     * @Route("/", name="agenda", methods={"GET"})
     */
    public function fullCalendar(ConsultCalendarRepository $consultCalendarRepository): Response
    {
        return $this->render('consult_calendar/calendar.html.twig');
    }

    /**
     * @Route("/new", name="consult_calendar_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $consultCalendar = new ConsultCalendar();
        $form = $this->createForm(ConsultCalendarType::class, $consultCalendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultCalendar);
            $entityManager->flush();

            return $this->redirectToRoute('agenda_list');
        }

        return $this->render('consult_calendar/new.html.twig', [
            'consult_calendar' => $consultCalendar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consult_show", methods={"GET"})
     */
    public function show(ConsultCalendar $consultCalendar): Response
    {
        return $this->render('consult_calendar/show.html.twig', [
            'consult_calendar' => $consultCalendar,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="consult_calendar_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ConsultCalendar $consultCalendar): Response
    {
        $form = $this->createForm(ConsultCalendarType::class, $consultCalendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agenda_list');
        }

        return $this->render('consult_calendar/edit.html.twig', [
            'consult_calendar' => $consultCalendar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consult_calendar_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ConsultCalendar $consultCalendar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultCalendar->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consultCalendar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agenda');
    }

    /**
     * @Route("/calendar", name="consult_calendar", methods={"GET"})
     */
    public function calendar(): Response
    {
        return $this->render('consult_calendar/calendar.html.twig');
    }

    /**
     * @Route("/save", name="consult_calendar_save", methods={"GET","POST"})
     */
    public function save(Request $request): Response
    {
      
        $title = $request->request->get("title");

        $start= new \DateTime($request->request->get("start"));
        $end = new \DateTime($request->request->get("end"));

      
        $consultCalendar = new ConsultCalendar();
        $consultCalendar->setTitle($title);
        $consultCalendar->setStartDate($start);
        $consultCalendar->setEndDate($end);
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($consultCalendar);
        $entityManager->flush();
        

        return new Response('Done',200);
    }

    /**
     * @Route("/modify/{id}", name="consult_calendar_modify", methods={"GET","POST"})
     */
    public function modify(Request $request,ConsultCalendar $consultCalendar): Response
    {
      
        $title = $request->request->get("title");

        $start= new \DateTime($request->request->get("start"));
        $end = new \DateTime($request->request->get("end"));

      
        $consultCalendar->setTitle($title);
        $consultCalendar->setStartDate($start);
        $consultCalendar->setEndDate($end);
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($consultCalendar);
        $entityManager->flush();
        

        return new Response('Done',200);
    }
}
