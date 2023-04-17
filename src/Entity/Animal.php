<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $sex = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?animalTypeEnum $type = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Owner $owner = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $antecedent = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentary = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: consult::class, orphanRemoval: true)]
    private Collection $consults;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $race = null;

    public function __construct()
    {
        $this->consults = new ArrayCollection();
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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getSex(): ?int
    {
        return $this->sex;
    }

    public function setSex(int $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getType(): ?animalTypeEnum
    {
        return $this->type;
    }

    public function setType(?animalTypeEnum $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getAntecedent(): ?string
    {
        return $this->antecedent;
    }

    public function setAntecedent(?string $antecedent): self
    {
        $this->antecedent = $antecedent;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    /**
     * @return Collection<int, consult>
     */
    public function getConsults(): Collection
    {
        return $this->consults;
    }

    public function addConsult(consult $consult): self
    {
        if (!$this->consults->contains($consult)) {
            $this->consults->add($consult);
            $consult->setAnimal($this);
        }

        return $this;
    }

    public function removeConsult(consult $consult): self
    {
        if ($this->consults->removeElement($consult)) {
            // set the owning side to null (unless already changed)
            if ($consult->getAnimal() === $this) {
                $consult->setAnimal(null);
            }
        }

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(?string $race): self
    {
        $this->race = $race;

        return $this;
    }
}
