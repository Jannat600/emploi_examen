<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: Module::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $module;

    #[ORM\ManyToOne(targetEntity: Horaire::class, inversedBy: 'seances')]
    private $horaire;

    #[ORM\ManyToOne(targetEntity: Salle::class)]
    private $salle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getHoraire(): ?Horaire
    {
        return $this->horaire;
    }

    public function setHoraire(?Horaire $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
