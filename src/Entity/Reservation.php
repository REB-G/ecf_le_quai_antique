<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Assert\NotBlank('Veuillez renseigner la date pour les réservation.')]
    private ?\DateTimeInterface $reservationDate = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    #[Assert\NotBlank('Veuillez renseigner l\'heure pour les réservation.')]
    private ?\DateTimeInterface $reservationTime = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?Users $user = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?Tables $restaurantTable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationDate(): ?\DateTimeInterface
    {
        return $this->reservationDate;
    }

    public function setReservationDate(\DateTimeInterface $reservationDate): self
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    public function getReservationTime(): ?\DateTimeInterface
    {
        return $this->reservationTime;
    }

    public function setReservationTime(\DateTimeInterface $reservationTime): self
    {
        $this->reservationTime = $reservationTime;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRestaurantTable(): ?Tables
    {
        return $this->restaurantTable;
    }

    public function setRestaurantTable(?Tables $restaurantTable): self
    {
        $this->restaurantTable = $restaurantTable;

        return $this;
    }
}
