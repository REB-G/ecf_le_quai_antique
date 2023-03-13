<?php

namespace App\Entity;

use App\Entity\Allergies;
use Doctrine\DBAL\Types\Types;
use App\Entity\ReservationTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\GreaterThan("now", message: "La date de réservation doit être supérieure à la date du jour")]
    private ?\DateTimeInterface $reservationDate = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?Users $user = null;

    #[ORM\Column]
    #[Assert\Range(min: 1, max: 40, notInRangeMessage: "Le nombre de personnes doit être compris entre 1 et 40")]
    private ?int $numberOfGuests = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: Allergies::class, inversedBy: 'reservation')]
    #[ORM\JoinTable(name: 'reservation_allergies')]
    private Collection $allergy;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner un nom")]
    #[Assert\Length(max: 255, maxMessage: "Le nom ne doit pas dépasser 255 caractères")]
    #[Assert\Regex(pattern: "/^[a-zA-ZÀ-ÿ -]+$/", message: "Le nom ne doit contenir que des lettres")]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner un nom")]
    #[Assert\Length(max: 255, maxMessage: "Le nom ne doit pas dépasser 255 caractères")]
    #[Assert\Regex(pattern: "/^[a-zA-ZÀ-ÿ -]+$/", message: "Le nom ne doit contenir que des lettres")]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner un email")]
    #[Assert\Email(message: "Veuillez renseigner un email valide")]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?ReservationTime $reservationHour = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Services $service = null;

    public function __construct()
    {
        $this->allergy = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

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

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNumberOfGuests(): ?int
    {
        return $this->numberOfGuests;
    }

    public function setNumberOfGuests(int $numberOfGuests): self
    {
        $this->numberOfGuests = $numberOfGuests;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAllergy(): Collection
    {
        return $this->allergy;
    }

    public function addAllergy(Allergies $allergy): self
    {
        if (!$this->allergy->contains($allergy)) {
            $this->allergy->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(Allergies $allergy): self
    {
        $this->allergy->removeElement($allergy);

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getReservationHour(): ?ReservationTime
    {
        return $this->reservationHour;
    }

    public function setReservationHour(?ReservationTime $reservationHour): self
    {
        $this->reservationHour = $reservationHour;

        return $this;
    }

    public function getService(): ?Services
    {
        return $this->service;
    }

    public function setService(?Services $service): self
    {
        $this->service = $service;

        return $this;
    }
    public function __toString(): string
    {
        return $this->reservationDate->format('d/m/Y')
        . ' ' . $this->reservationHour->getHour()
        . ' ' . $this->service->getName()
        . ' ' . $this->name
        . ' ' . $this->firstname
        . ' ' . $this->email
        . ' ' . $this->numberOfGuests
        . ' ' . $this->allergy
        . ' ' . $this->createdAt->format('d/m/Y')
        . ' ' . $this->user->getname()
        . ' ' . $this->user->getfirstname()
        . ' ' . $this->user->getEmail()
        . ' ' . $this->user->getDefaultNumberOfGuests()
        . ' ' . $this->user->getAllergy();
    }
}
