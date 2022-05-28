<?php

namespace App\Entity;

use App\Repository\EmploiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmploiRepository::class)]
class Emploi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $intitule;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_creation;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_expiration;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'emplois')]
    private $user;

    #[ORM\OneToMany(mappedBy: 'emploi', targetEntity: Jour::class)]
    private $jour;

    #[ORM\OneToOne(targetEntity: Semestre::class, cascade: ['persist', 'remove'])]
    private $semestre;

    #[ORM\ManyToOne(targetEntity: AnneeUniv::class, inversedBy: 'emplois')]
    private $annee_univ;

    public function __construct()
    {
        $this->jour = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(?\DateTimeInterface $date_expiration): self
    {
        $this->date_expiration = $date_expiration;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $jour->setEmploi($this);
        }

        return $this;
    }

    public function removeJour(Jour $jour): self
    {
        if ($this->jour->removeElement($jour)) {
            // set the owning side to null (unless already changed)
            if ($jour->getEmploi() === $this) {
                $jour->setEmploi(null);
            }
        }

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?Semestre $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getAnneeUniv(): ?AnneeUniv
    {
        return $this->annee_univ;
    }

    public function setAnneeUniv(?AnneeUniv $annee_univ): self
    {
        $this->annee_univ = $annee_univ;

        return $this;
    }
}
