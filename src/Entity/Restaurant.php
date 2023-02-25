<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column]
    private ?int $nbrTotalOfPlaces = null;

    #[ORM\Column(length: 255)]
    private ?string $openingDays = null;

    #[ORM\Column(length: 255)]
    private ?string $openingHours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getNbrTotalOfPlaces(): ?int
    {
        return $this->nbrTotalOfPlaces;
    }

    public function setNbrTotalOfPlaces(int $nbrTotalOfPlaces): self
    {
        $this->nbrTotalOfPlaces = $nbrTotalOfPlaces;

        return $this;
    }

    public function getOpeningDays(): ?string
    {
        return $this->openingDays;
    }

    public function setOpeningDays(string $openingDays): self
    {
        $this->openingDays = $openingDays;

        return $this;
    }

    public function getOpeningHours(): ?string
    {
        return $this->openingHours;
    }

    public function setOpeningHours(string $openingHours): self
    {
        $this->openingHours = $openingHours;

        return $this;
    }
}
