<?php

namespace App\Entity;

use App\Repository\TechnicienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechnicienRepository::class)]
class Technicien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'leTechnicien', targetEntity: Visite::class)]
    private Collection $lesVisites;

    #[ORM\ManyToOne(inversedBy: 'lesTechniciens')]
    private ?Maintenance $laMaintenance = null;

    public function __construct()
    {
        $this->lesVisites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Visite>
     */
    public function getLesVisites(): Collection
    {
        return $this->lesVisites;
    }

    public function addLesVisite(Visite $lesVisite): static
    {
        if (!$this->lesVisites->contains($lesVisite)) {
            $this->lesVisites->add($lesVisite);
            $lesVisite->setLeTechnicien($this);
        }

        return $this;
    }

    public function removeLesVisite(Visite $lesVisite): static
    {
        if ($this->lesVisites->removeElement($lesVisite)) {
            // set the owning side to null (unless already changed)
            if ($lesVisite->getLeTechnicien() === $this) {
                $lesVisite->setLeTechnicien(null);
            }
        }

        return $this;
    }

    public function getLaMaintenance(): ?Maintenance
    {
        return $this->laMaintenance;
    }

    public function setLaMaintenance(?Maintenance $laMaintenance): static
    {
        $this->laMaintenance = $laMaintenance;

        return $this;
    }
}
