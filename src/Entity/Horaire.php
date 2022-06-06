<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'time', nullable: true)]
    private $debut;

    #[ORM\Column(type: 'time', nullable: true)]
    private $fin;

    #[ORM\OneToMany(mappedBy: 'horaire', targetEntity: Seance::class)]
    private $seances;

    #[ORM\ManyToMany(targetEntity: Jour::class, inversedBy: 'horaires')]
    private $jour;

    public function __construct()
    {
        $this->seances = new ArrayCollection();
        $this->jour = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(?\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(?\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

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
            $seance->setHoraire($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getHoraire() === $this) {
                $seance->setHoraire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jour>
     */
    public function getJour(): Collection
    {
        return $this->jour;
    }

    public function addJour(Jour $jour): self
    {
        if (!$this->jour->contains($jour)) {
            $this->jour[] = $jour;
        }

        return $this;
    }

    public function removeJour(Jour $jour): self
    {
        $this->jour->removeElement($jour);

        return $this;
    }

    public function __toString()
    {
        $a = $this->debut->format('H:i');
        $b =' : ' ;
        $c= $this->fin->format('H:i');
        return $a.$b.$c;
    }
}
