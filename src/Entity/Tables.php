<?php

namespace App\Entity;

use App\Repository\TablesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TablesRepository::class)]
class Tables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(type: 'integer', unique: true)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le numéro de la table.')]
    private ?int $tableNumber = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'Veuillez renseigner le nombre de places de la table.')]
    private ?int $numberOfPlaces = null;

    #[ORM\Column(type: 'boolean')]
    #[Assert\NotBlank(message: 'Veuillez indiquer si la table est disponible ou non.')]
    private ?bool $isAvailable = null;

    #[ORM\ManyToOne(inversedBy: 'restaurantTable')]
    private ?Users $user = null;

    #[ORM\OneToMany(mappedBy: 'restaurantTable', targetEntity: Reservation::class)]
    private Collection $reservation;

    public function __construct()
    {
        $this->reservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTableNumber(): ?int
    {
        return $this->tableNumber;
    }

    public function setTableNumber(int $tableNumber): self
    {
        $this->tableNumber = $tableNumber;

        return $this;
    }

    public function getNumberOfPlaces(): ?int
    {
        return $this->numberOfPlaces;
    }

    public function setNumberOfPlaces(int $numberOfPlaces): self
    {
        $this->numberOfPlaces = $numberOfPlaces;

        return $this;
    }

    public function isIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

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

    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation->add($reservation);
            $reservation->setRestaurantTable($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRestaurantTable() === $this) {
                $reservation->setRestaurantTable(null);
            }
        }

        return $this;
    }
}
