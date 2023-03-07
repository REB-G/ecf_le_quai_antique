<?php

namespace App\Entity;

use App\Repository\OpeningDaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningDaysRepository::class)]
class OpeningDays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\ManyToMany(targetEntity: Services::class, inversedBy: 'days')]
    private Collection $service;

    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Services $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        $this->service->removeElement($service);

        return $this;
    }

    public function __toString(): string
    {
        return $this->day;
    }
}
