<?php

namespace App\Entity;

use App\Repository\MenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MenusRepository::class)]
class Menus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le nom du menu.')]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez renseigner le prix du menu.')]
    #[Assert\Positive(message: 'Le prix du menu doit être supérieur à 0.')]
    private ?float $price = null;

    #[ORM\ManyToMany(targetEntity: Dishes::class, mappedBy: 'menu')]
    private Collection $dish;

    public function __construct()
    {
        $this->dish = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function geTTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDish(): Collection
    {
        return $this->dish;
    }

    public function addDish(Dishes $dish): self
    {
        if (!$this->dish->contains($dish)) {
            $this->dish->add($dish);
            $dish->addMenu($this);
        }

        return $this;
    }

    public function removeDish(Dishes $dish): self
    {
        if ($this->dish->removeElement($dish)) {
            $dish->removeMenu($this);
        }

        return $this;
    }
}
