<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $intitule;

    #[ORM\ManyToOne(targetEntity: Filiere::class, inversedBy: 'niveaux')]
    private $filiere;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Semestre::class)]
    private $semestre;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Upfien::class)]
    private $upfiens;

    #[ORM\ManyToMany(targetEntity: Module::class, inversedBy: 'niveaux')]
    private $modules;

    public function __construct()
    {
        $this->semestre = new ArrayCollection();
        $this->upfiens = new ArrayCollection();
        $this->modules = new ArrayCollection();
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

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * @return Collection<int, Semestre>
     */
    public function getSemestre(): Collection
    {
        return $this->semestre;
    }

    public function addSemestre(Semestre $semestre): self
    {
        if (!$this->semestre->contains($semestre)) {
            $this->semestre[] = $semestre;
            $semestre->setNiveau($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): self
    {
        if ($this->semestre->removeElement($semestre)) {
            // set the owning side to null (unless already changed)
            if ($semestre->getNiveau() === $this) {
                $semestre->setNiveau(null);
            }
        }

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
            $upfien->setNiveau($this);
        }

        return $this;
    }

    public function removeUpfien(Upfien $upfien): self
    {
        if ($this->upfiens->removeElement($upfien)) {
            // set the owning side to null (unless already changed)
            if ($upfien->getNiveau() === $this) {
                $upfien->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        $this->modules->removeElement($module);

        return $this;
    }

    public function __toString()
    {
        $a = $this->intitule;
        $b = $this->filiere;
        return $b." ".$a;
    }
}
