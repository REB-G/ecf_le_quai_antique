<?php

namespace App\Entity;

use App\Repository\AllergiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AllergiesRepository::class)]
class Allergies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le nom de l\'allergie.')]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'idAllergy')]
    private Collection $idUser;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
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

    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(Users $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser->add($idUser);
            $idUser->addIdAllergy($this);
        }

        return $this;
    }

    public function removeIdUser(Users $idUser): self
    {
        if ($this->idUser->removeElement($idUser)) {
            $idUser->removeIdAllergy($this);
        }

        return $this;
    }
}
