<?php

namespace App\Controller;

use App\DTO\TicketBookingDTO;
use App\Entity\Ticket;
use App\Form\TicketBookingForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ticket")
 */
class TicketBookingController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/buy", name="app.ticket.buy")
     */
    public function buyAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dto = new TicketBookingDTO();
        $form = $this->createForm(TicketBookingForm::class, $dto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = Ticket::createFromDTO($dto);
            $date = getdate(date_timestamp_get($dto->getDate()));
            $price = $dto->getFlightId()->getBasePrice();
            if ($date["wday"] === 0 || $date["wday"] === 6) {
                $price *= 2;
            }
            $ticket->setPrice($price);
            $entityManager->persist($ticket);
            $entityManager->flush();
            $id = $ticket->getId();
            return $this->redirectToRoute('app.ticket.view', ["id" => $id]);
        }
        return $this->renderForm('ticket_booking.html.twig', [
            "ticket_booking_form" => $form
        ]);
    }

    /**
     * @Route("/view/{id}", name="app.ticket.view")
     */
    public function viewAction($id): Response
    {
        $ticket = $this->getDoctrine()->getRepository(Ticket::class)->findOneBy(["id" => $id]);
        dump($ticket);
        return $this->render('ticket.html.twig', [
            "ticket" => $ticket
        ]);
    }
}