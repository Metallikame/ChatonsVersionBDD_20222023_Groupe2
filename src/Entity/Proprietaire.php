<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProprietaireRepository::class)
 */
class Proprietaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\ManyToMany(targetEntity=Chaton::class, mappedBy="proprietaire")
     */
    private $proprietaire;

    public function __construct()
    {
        $this->proprietaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Chaton>
     */
    public function getProprietaire(): Collection
    {
        return $this->proprietaire;
    }

    public function addProprietaire(Chaton $proprietaire): self
    {
        if (!$this->proprietaire->contains($proprietaire)) {
            $this->proprietaire[] = $proprietaire;
            $proprietaire->addProprietaire($this);
        }

        return $this;
    }

    public function removeProprietaire(Chaton $proprietaire): self
    {
        if ($this->proprietaire->removeElement($proprietaire)) {
            $proprietaire->removeProprietaire($this);
        }

        return $this;
    }
}
