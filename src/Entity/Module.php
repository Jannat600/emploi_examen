<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $intitule;

    #[ORM\ManyToMany(targetEntity: Upfien::class, mappedBy: 'module')]
    private $upfiens;

    #[ORM\ManyToMany(targetEntity: Niveau::class, mappedBy: 'modules')]
    private $niveaux;

    public function __construct()
    {
        $this->upfiens = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
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

    /**
     * @return Collection<int, Upfien>
     */
    public function getUpfiens(): Collection
    {
        return $this->upfiens;
    }

    public function addUpfien(Upfien $upfien): self
    {
        if (!$this->upfiens->contains($upfien)) {
            $this->upfiens[] = $upfien;
            $upfien->addModule($this);
        }

        return $this;
    }

    public function removeUpfien(Upfien $upfien): self
    {
        if ($this->upfiens->removeElement($upfien)) {
            $upfien->removeModule($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Niveau>
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->addModule($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->removeElement($niveau)) {
            $niveau->removeModule($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->intitule;
    }
}
