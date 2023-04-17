<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 70)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'practitioner', targetEntity: Consult::class, orphanRemoval: true)]
    private Collection $consults;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Consult>
     */
    public function getConsults(): Collection
    {
        return $this->consults;
    }

    public function addConsult(Consult $consult): self
    {
        if (!$this->consults->contains($consult)) {
            $this->consults->add($consult);
            $consult->setPractitioner($this);
        }

        return $this;
    }

    public function removeConsult(Consult $consult): self
    {
        if ($this->consults->removeElement($consult)) {
            // set the owning side to null (unless already changed)
            if ($consult->getPractitioner() === $this) {
                $consult->setPractitioner(null);
            }
        }

        return $this;
    }
}
