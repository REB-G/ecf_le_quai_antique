<?php

namespace App\Entity;

use App\Repository\DishesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DishesRepository::class)]
class Dishes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le nom du plat.')]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner la description du plat.')]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez renseigner le prix du plat.')]
    #[Assert\Positive(message: 'Le prix du plat doit être supérieur à 0.')]
    private ?float $price = null;

    #[ORM\Column(type: Types::BLOB)]
    #[Assert\NotBlank(message: 'Veuillez renseigner l\'image du plat.')]
    private $picture = null;

    #[ORM\ManyToOne(inversedBy: 'dish')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $category = null;

    #[ORM\ManyToMany(targetEntity: Menus::class, inversedBy: 'dish')]
    private Collection $menu;

    public function __construct()
    {
        $this->menu = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(Menus $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu->add($menu);
        }

        return $this;
    }

    public function removeMenu(Menus $menu): self
    {
        $this->menu->removeElement($menu);

        return $this;
    }
}

