<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class PassengerDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=255, maxMessage="Фамилия не может содержать более {{ limit }} символов")
     */
    private ?string $last_name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=255, maxMessage="Имя не может содеражть более {{ limit }} симвоов")
     */
    private ?string $first_name;

    /**
     * @Assert\Length(max=255, maxMessage="Отчество не может содержать более {{ limit }} символов")
     */
    private ?string $middle_name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=4, exactMessage="Серия паспорта должна содержать ровно {{ limit }} цифры")
     */
    private ?string $passport_series;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6, max=6, exactMessage="Серия паспорта должна содержать ровно {{ limit }} цифры")
     */
    private ?string $passport_number;

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string|null $last_name
     */
    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string|null $first_name
     */
    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    /**
     * @param string|null $middle_name
     */
    public function setMiddleName(?string $middle_name): void
    {
        $this->middle_name = $middle_name;
    }

    /**
     * @return string|null
     */
    public function getPassportSeries(): ?string
    {
        return $this->passport_series;
    }

    /**
     * @param string|null $passport_series
     */
    public function setPassportSeries(?string $passport_series): void
    {
        $this->passport_series = $passport_series;
    }

    /**
     * @return string|null
     */
    public function getPassportNumber(): ?string
    {
        return $this->passport_number;
    }

    /**
     * @param string|null $passport_number
     */
    public function setPassportNumber(?string $passport_number): void
    {
        $this->passport_number = $passport_number;
    }
}