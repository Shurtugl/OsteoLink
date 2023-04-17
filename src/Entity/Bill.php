<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillRepository::class)]
class Bill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\OneToOne(inversedBy: 'bill', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?consult $consult = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $solved = null;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getConsult(): ?consult
    {
        return $this->consult;
    }

    public function setConsult(consult $consult): self
    {
        $this->consult = $consult;

        return $this;
    }

    public function getSolved(): ?\DateTimeInterface
    {
        return $this->solved;
    }

    public function setSolved(?\DateTimeInterface $solved): self
    {
        $this->solved = $solved;

        return $this;
    }
}
