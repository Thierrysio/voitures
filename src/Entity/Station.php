<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $idStation = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleEmplacement = null;

    #[ORM\OneToMany(mappedBy: 'laStation', targetEntity: Visite::class)]
    private Collection $lesVisites;

    #[ORM\OneToMany(mappedBy: 'laStation', targetEntity: Borne::class)]
    private Collection $lesBornes;

    public function __construct()
    {
        $this->lesVisites = new ArrayCollection();
        $this->lesBornes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdStation(): ?int
    {
        return $this->idStation;
    }

    public function setIdStation(?int $idStation): static
    {
        $this->idStation = $idStation;

        return $this;
    }

    public function getLibelleEmplacement(): ?string
    {
        return $this->libelleEmplacement;
    }

    public function setLibelleEmplacement(string $libelleEmplacement): static
    {
        $this->libelleEmplacement = $libelleEmplacement;

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
            $lesVisite->setLaStation($this);
        }

        return $this;
    }

    public function removeLesVisite(Visite $lesVisite): static
    {
        if ($this->lesVisites->removeElement($lesVisite)) {
            // set the owning side to null (unless already changed)
            if ($lesVisite->getLaStation() === $this) {
                $lesVisite->setLaStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Borne>
     */
    public function getLesBornes(): Collection
    {
        return $this->lesBornes;
    }

    public function addLesBorne(Borne $lesBorne): static
    {
        if (!$this->lesBornes->contains($lesBorne)) {
            $this->lesBornes->add($lesBorne);
            $lesBorne->setLaStation($this);
        }

        return $this;
    }

    public function removeLesBorne(Borne $lesBorne): static
    {
        if ($this->lesBornes->removeElement($lesBorne)) {
            // set the owning side to null (unless already changed)
            if ($lesBorne->getLaStation() === $this) {
                $lesBorne->setLaStation(null);
            }
        }

        return $this;
    }
    public function getVisiteAFaire() : Visite {
        // Tableau des bornes à visiter
        $bornesAVisiter = [];

        // Parcourir toutes les bornes de la station
        foreach ($this->lesBornes as $borne) {
            if ($borne->estAReviser()) {
                $bornesAVisiter[] = $borne;
            }
        }

        // Si aucune borne à visiter, retourner null
        if (count($bornesAVisiter) == 0) {
            return null;
        }

        // Sinon, retourner une instance de classe Visite
        return new Visite($bornesAVisiter, $this);
    }

}
