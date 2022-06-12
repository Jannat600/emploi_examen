<?php

namespace App\Entity;

use App\Repository\AnneeUnivRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeUnivRepository::class)]
class AnneeUniv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    private $annee_debut;

    #[ORM\Column(type: 'date', nullable: true)]
    private $annee_fin;

    #[ORM\OneToMany(mappedBy: 'annee_univ', targetEntity: Emploi::class)]
    private $emplois;

    public function __construct()
    {
        $this->emplois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeDebut(): ?\DateTimeInterface
    {
        return $this->annee_debut;
    }

    public function setAnneeDebut(?\DateTimeInterface $annee_debut): self
    {
        $this->annee_debut = $annee_debut;

        return $this;
    }

    public function getAnneeFin(): ?\DateTimeInterface
    {
        return $this->annee_fin;
    }

    public function setAnneeFin(?\DateTimeInterface $annee_fin): self
    {
        $this->annee_fin = $annee_fin;

        return $this;
    }

    /**
     * @return Collection<int, Emploi>
     */
    public function getEmplois(): Collection
    {
        return $this->emplois;
    }

    public function addEmploi(Emploi $emploi): self
    {
        if (!$this->emplois->contains($emploi)) {
            $this->emplois[] = $emploi;
            $emploi->setAnneeUniv($this);
        }

        return $this;
    }

    public function removeEmploi(Emploi $emploi): self
    {
        if ($this->emplois->removeElement($emploi)) {
            // set the owning side to null (unless already changed)
            if ($emploi->getAnneeUniv() === $this) {
                $emploi->setAnneeUniv(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        $a = $this->annee_debut->format('Y');
        $b =' - ' ;
        $c= $this->annee_fin->format('Y');
        return $a.$b.$c;
    }
}
