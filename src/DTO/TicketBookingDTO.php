<?php

namespace App\DTO;

use App\Entity\Flight;
use App\Entity\Passenger;
use Symfony\Component\Validator\Constraints as Assert;

class TicketBookingDTO
{
    /**
     * @Assert\NotBlank()
     */
    private ?Flight $flight_id;

    /**
     * @Assert\NotBlank()
     */
    private ?Passenger $passenger_id;

    /**
     * @Assert\NotBlank 
     */
    private \DateTimeInterface $date;

    public function getFlightId(): ?Flight
    {
        return $this->flight_id;
    }

    public function setFlightId(?Flight $flight_id): void
    {
        $this->flight_id = $flight_id;
    }

    public function getPassengerId(): ?Passenger
    {
        return $this->passenger_id;
    }

    public function setPassengerId(?Passenger $passenger_id): void
    {
        $this->passenger_id = $passenger_id;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): void
    {
        $this->date = $date;
    }
}