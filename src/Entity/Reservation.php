<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDateReservation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDateReservation = null;

    #[ORM\Column]
    private ?bool $isReserved = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Prestation $prestation = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDateReservation(): ?\DateTimeInterface
    {
        return $this->startDateReservation;
    }

    public function setStartDateReservation(\DateTimeInterface $startDateReservation): static
    {
        $this->startDateReservation = $startDateReservation;

        return $this;
    }

    public function getEndDateReservation(): ?\DateTimeInterface
    {
        return $this->endDateReservation;
    }

    public function setEndDateReservation(\DateTimeInterface $endDateReservation): static
    {
        $this->endDateReservation = $endDateReservation;

        return $this;
    }

    public function isReserved(): ?bool
    {
        return $this->isReserved;
    }

    public function setIsReserved(bool $isReserved): static
    {
        $this->isReserved = $isReserved;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): static
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
