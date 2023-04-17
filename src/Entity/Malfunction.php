<?php

namespace App\Entity;

use App\Repository\MalfunctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MalfunctionRepository::class)]
class Malfunction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $locationX = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $locationY = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $technicType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tissuType = null;

    #[ORM\ManyToMany(targetEntity: consult::class, inversedBy: 'malfunctions')]
    private Collection $consult;

    public function __construct()
    {
        $this->consult = new ArrayCollection();
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

    public function getLocationX(): ?int
    {
        return $this->locationX;
    }

    public function setLocationX(?int $locationX): self
    {
        $this->locationX = $locationX;

        return $this;
    }

    public function getLocationY(): ?int
    {
        return $this->locationY;
    }

    public function setLocationY(?int $locationY): self
    {
        $this->locationY = $locationY;

        return $this;
    }

    public function getTechnicType(): ?string
    {
        return $this->technicType;
    }

    public function setTechnicType(?string $technicType): self
    {
        $this->technicType = $technicType;

        return $this;
    }

    public function getTissuType(): ?string
    {
        return $this->tissuType;
    }

    public function setTissuType(?string $tissuType): self
    {
        $this->tissuType = $tissuType;

        return $this;
    }

    /**
     * @return Collection<int, consult>
     */
    public function getConsult(): Collection
    {
        return $this->consult;
    }

    public function addConsult(consult $consult): self
    {
        if (!$this->consult->contains($consult)) {
            $this->consult->add($consult);
        }

        return $this;
    }

    public function removeConsult(consult $consult): self
    {
        $this->consult->removeElement($consult);

        return $this;
    }
}
