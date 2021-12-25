<?php

namespace App\Controller;

use App\DTO\PassengerDTO;
use App\Entity\Passenger;
use App\Form\PassengerForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/passenger")
 */
class PassengerController extends AbstractController
{
    /**
     * @Route("/", name="app.passenger")
     */
    public function indexAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dto = new PassengerDTO();
        $form = $this->createForm(PassengerForm::class, $dto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passenger = Passenger::createFromDTO($dto);
            $entityManager->persist($passenger);
            $entityManager->flush();
            return $this->redirectToRoute("other_test");
        }
        return $this->renderForm('passenger.html.twig', [
            "passenger_form" => $form,
        ]);
    }
}