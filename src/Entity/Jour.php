<?php

namespace App\Entity;

use App\Repository\JourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourRepository::class)]
class Jour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom_jour;

    #[ORM\ManyToMany(targetEntity: Horaire::class, mappedBy: 'jour')]
    private $horaires;

    #[ORM\ManyToOne(targetEntity: Emploi::class, inversedBy: 'jour')]
    private $emploi;

    #[ORM\OneToMany(mappedBy: 'jour', targetEntity: Seance::class, cascade: ['persist', 'remove'])]
    private $seances;

    public function __construct()
    {
        $this->horaires = new ArrayCollection();
        $this->seances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJour(): ?string
    {
        return $this->nom_jour;
    }

    public function setNomJour(string $nom_jour): self
    {
        $this->nom_jour = $nom_jour;

        return $this;
    }

    /**
     * @return Collection<int, Horaire>
     */
    public function getHoraires(): Collection
    {
        return $this->horaires;
    }

    public function addHoraire(Horaire $horaire): self
    {
        if (!$this->horaires->contains($horaire)) {
            $this->horaires[] = $horaire;
            $horaire->addJour($this);
        }

        return $this;
    }

    public function removeHoraire(Horaire $horaire): self
    {
        if ($this->horaires->removeElement($horaire)) {
            $horaire->removeJour($this);
        }

        return $this;
    }

    public function getEmploi(): ?Emploi
    {
        return $this->emploi;
    }

    public function setEmploi(?Emploi $emploi): self
    {
        $this->emploi = $emploi;

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seances->contains($seance)) {
            $this->seances[] = $seance;
            $seance->setJour($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getJour() === $this) {
                $seance->setJour(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom_jour;
    }
}
