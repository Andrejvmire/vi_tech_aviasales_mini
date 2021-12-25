<?php

namespace App\Entity;

use App\DTO\PassengerDTO;
use App\Repository\PassengerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PassengerRepository::class)
 */
class Passenger
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $middle_name;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private ?string $passport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="passenger")
     */
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public static function createFromDTO(PassengerDTO $DTO): self
    {
        $user = new self();
        $user->setFirstName($DTO->getFirstName());
        $user->setLastName($DTO->getLastName());
        $user->setMiddleName($DTO->getMiddleName());
        $user->setPassport(sprintf("%s %s", $DTO->getPassportSeries(), $DTO->getPassportNumber()));
        return $user;
    }

    public function __toString()
    {
        return sprintf('%s %s %s (%s)',
            $this->last_name,
            $this->first_name,
            $this->middle_name,
            $this->passport
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(string $passport): self
    {
        $this->passport = $passport;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    public function setMiddleName(string $middle_name): self
    {
        $this->middle_name = $middle_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * @return ArrayCollection|Ticket[]
     */
    public function getTickets(): ArrayCollection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setPassenger($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getPassenger() === $this) {
                $ticket->setPassenger(null);
            }
        }

        return $this;
    }
}
