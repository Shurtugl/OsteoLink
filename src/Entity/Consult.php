<?php

namespace App\Entity;

use App\Repository\ConsultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultRepository::class)]
class Consult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50)]
    private ?string $motive = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $advices = null;

    #[ORM\ManyToOne(inversedBy: 'consults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $practitioner = null;

    #[ORM\ManyToMany(targetEntity: Malfunction::class, mappedBy: 'consult')]
    private Collection $malfunctions;

    #[ORM\OneToOne(mappedBy: 'consult', cascade: ['persist', 'remove'])]
    private ?Bill $bill = null;

    #[ORM\ManyToOne(inversedBy: 'consults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    public function __construct()
    {
        $this->malfunctions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMotive(): ?string
    {
        return $this->motive;
    }

    public function setMotive(string $motive): self
    {
        $this->motive = $motive;

        return $this;
    }

    public function getAdvices(): ?string
    {
        return $this->advices;
    }

    public function setAdvices(?string $advices): self
    {
        $this->advices = $advices;

        return $this;
    }

    public function getPractitioner(): ?user
    {
        return $this->practitioner;
    }

    public function setPractitioner(?user $practitioner): self
    {
        $this->practitioner = $practitioner;

        return $this;
    }

    /**
     * @return Collection<int, Malfunction>
     */
    public function getMalfunctions(): Collection
    {
        return $this->malfunctions;
    }

    public function addMalfunction(Malfunction $malfunction): self
    {
        if (!$this->malfunctions->contains($malfunction)) {
            $this->malfunctions->add($malfunction);
            $malfunction->addConsult($this);
        }

        return $this;
    }

    public function removeMalfunction(Malfunction $malfunction): self
    {
        if ($this->malfunctions->removeElement($malfunction)) {
            $malfunction->removeConsult($this);
        }

        return $this;
    }

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(Bill $bill): self
    {
        // set the owning side of the relation if necessary
        if ($bill->getConsult() !== $this) {
            $bill->setConsult($this);
        }

        $this->bill = $bill;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}
