<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: ReservationTime::class)]
    private Collection $hours;

    #[ORM\ManyToMany(targetEntity: OpeningDays::class, mappedBy: 'service')]
    private Collection $days;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->hours = new ArrayCollection();
        $this->days = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ReservationTime>
     */
    public function getHours(): Collection
    {
        return $this->hours;
    }

    public function addHour(ReservationTime $hour): self
    {
        if (!$this->hours->contains($hour)) {
            $this->hours->add($hour);
            $hour->setService($this);
        }

        return $this;
    }

    public function removeHour(ReservationTime $hour): self
    {
        if ($this->hours->removeElement($hour)) {
            // set the owning side to null (unless already changed)
            if ($hour->getService() === $this) {
                $hour->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OpeningDays>
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(OpeningDays $day): self
    {
        if (!$this->days->contains($day)) {
            $this->days->add($day);
            $day->addService($this);
        }

        return $this;
    }

    public function removeDay(OpeningDays $day): self
    {
        if ($this->days->removeElement($day)) {
            $day->removeService($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setService($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getService() === $this) {
                $reservation->setService(null);
            }
        }

        return $this;
    }
}
