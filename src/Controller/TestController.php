<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function testAction(): Response
    {
        return $this->render('ticket_booking.html.twig', [
            "last_name" => 'test',
            "first_name" => 'test11',
            'middle_name' => 'test45',
            "passport_series" => '3434',
            "passport_number" => '345678',
            "flight" => [
                [
                    'id' => 1,
                    'departure' => [
                        'city' => 'Moscow',
                        'code_iata' => 'SVO',
                    ],
                    'arrival' => [
                        'city' => 'SPb',
                        'code_iata' => 'LED',
                    ]
                ]
            ],
            "passenger" => [
                [
                    "id" => 1,
                    "full_name" => "Полное имя пассажира",
                    "passport" => "0000 000000",
                ]
            ]
        ]);
    }

    /**
     * @Route("/test", name="other_test")
     */
    public function test2Action()
    {
        return $this->render('ticket.html.twig', [
            "passenger" => [
                "id" => 1,
                "full_name" => "Полное имя пассажира",
                "passport" => "0000 000000",
            ],
            "ticket_date" => new \DateTime(),
            "flight" => [
                'id' => 1,
                'departure' => [
                    'city' => 'Moscow',
                    'code_iata' => 'SVO',
                ],
                'arrival' => [
                    'city' => 'SPb',
                    'code_iata' => 'LED',
                ]
            ],
            "price" => 2400
        ]);
    }
}