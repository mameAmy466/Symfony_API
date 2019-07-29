<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationRepository")
 */
class Operation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $montan;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="operations")
     */
    private $partenair;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="operations")
     */
    private $compte;

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

    public function getMontan(): ?float
    {
        return $this->montan;
    }

    public function setMontan(float $montan): self
    {
        $this->montan = $montan;

        return $this;
    }

    public function getPartenair(): ?Partenaire
    {
        return $this->partenair;
    }

    public function setPartenair(?Partenaire $partenair): self
    {
        $this->partenair = $partenair;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }
}
