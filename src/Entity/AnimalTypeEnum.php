<?php

namespace App\Entity;

use App\Repository\AnimalTypeEnumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalTypeEnumRepository::class)]
class AnimalTypeEnum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $specie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgAdress = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Animal::class, orphanRemoval: true)]
    private Collection $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecie(): ?string
    {
        return $this->specie;
    }

    public function setSpecie(string $specie): self
    {
        $this->specie = $specie;

        return $this;
    }

    public function getImgAdress(): ?string
    {
        return $this->imgAdress;
    }

    public function setImgAdress(?string $imgAdress): self
    {
        $this->imgAdress = $imgAdress;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setType($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getType() === $this) {
                $animal->setType(null);
            }
        }

        return $this;
    }
}
