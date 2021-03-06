<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private string $number;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="flight_departure")
     * @ORM\JoinColumn(nullable=false)
     */
    private Airport $departure;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="flight_arrival")
     * @ORM\JoinColumn(nullable=false)
     */
    private Airport $arrival;

    /**
     * @ORM\Column(type="smallint")
     */
    private int $status;

    /**
     * @ORM\Column(type="integer")
     */
    private int $duration;

    /**
     * @ORM\Column(type="float")
     */
    private float $base_price;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="flight")
     */
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function __toString()
    {
        return sprintf('%s (%s) - %s (%s)',
            $this->departure->getCity(),
            $this->departure->getCodeIata(),
            $this->arrival->getCity(),
            $this->arrival->getCodeIata()
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDeparture(): ?Airport
    {
        return $this->departure;
    }

    public function setDeparture(?Airport $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getArrival(): ?Airport
    {
        return $this->arrival;
    }

    public function setArrival(?Airport $arrival): self
    {
        $this->arrival = $arrival;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getBasePrice(): ?float
    {
        return $this->base_price;
    }

    public function setBasePrice(float $base_price): self
    {
        $this->base_price = $base_price;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setFlight($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getFlight() === $this) {
                $ticket->setFlight(null);
            }
        }

        return $this;
    }
}
