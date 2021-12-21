<?php

namespace App\Entity;

use App\Repository\AirportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AirportRepository::class)
 */
class Airport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $full_name;

    /**
     * @ORM\Column(type="string", length=199)
     */
    private ?string $city;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private string $code_iata;

    /**
     * @ORM\OneToMany(targetEntity=Flight::class, mappedBy="departure")
     */
    private $flight_departure;

    /**
     * @ORM\OneToMany(targetEntity=Flight::class, mappedBy="arrival")
     */
    private $flight_arrival;

    public function __construct()
    {
        $this->flight_departure = new ArrayCollection();
        $this->flight_arrival = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(?string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCodeIata(): ?string
    {
        return $this->code_iata;
    }

    public function setCodeIata(string $code_iata): self
    {
        $this->code_iata = $code_iata;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlightDeparture(): Collection
    {
        return $this->flight_departure;
    }

    public function addFlightDeparture(Flight $flightDeparture): self
    {
        if (!$this->flight_departure->contains($flightDeparture)) {
            $this->flight_departure[] = $flightDeparture;
            $flightDeparture->setDeparture($this);
        }

        return $this;
    }

    public function removeFlightDeparture(Flight $flightDeparture): self
    {
        if ($this->flight_departure->removeElement($flightDeparture)) {
            // set the owning side to null (unless already changed)
            if ($flightDeparture->getDeparture() === $this) {
                $flightDeparture->setDeparture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlightArrival(): Collection
    {
        return $this->flight_arrival;
    }

    public function addFlightArrival(Flight $flightArrival): self
    {
        if (!$this->flight_arrival->contains($flightArrival)) {
            $this->flight_arrival[] = $flightArrival;
            $flightArrival->setArrival($this);
        }

        return $this;
    }

    public function removeFlightArrival(Flight $flightArrival): self
    {
        if ($this->flight_arrival->removeElement($flightArrival)) {
            // set the owning side to null (unless already changed)
            if ($flightArrival->getArrival() === $this) {
                $flightArrival->setArrival(null);
            }
        }

        return $this;
    }
}
