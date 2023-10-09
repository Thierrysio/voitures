<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteRepository::class)]
class Visite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column]
    private ?int $dureeTotale = null;

    #[ORM\OneToMany(mappedBy: 'laVisite', targetEntity: Borne::class)]
    private Collection $lesBornes;

    #[ORM\ManyToOne(inversedBy: 'lesVisites')]
    private ?Station $laStation = null;

    #[ORM\ManyToOne(inversedBy: 'lesVisites')]
    private ?Technicien $leTechnicien = null;

    #[ORM\ManyToOne(inversedBy: 'lesVisites')]
    private ?Maintenance $laMaintenance = null;

    public function __construct()
    {
        $this->lesBornes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDureeTotale(): ?int
    {
        return $this->dureeTotale;
    }

    public function setDureeTotale(int $dureeTotale): static
    {
        $this->dureeTotale = $dureeTotale;

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
            $lesBorne->setLaVisite($this);
        }

        return $this;
    }

    public function removeLesBorne(Borne $lesBorne): static
    {
        if ($this->lesBornes->removeElement($lesBorne)) {
            // set the owning side to null (unless already changed)
            if ($lesBorne->getLaVisite() === $this) {
                $lesBorne->setLaVisite(null);
            }
        }

        return $this;
    }

    public function getLaStation(): ?Station
    {
        return $this->laStation;
    }

    public function setLaStation(?Station $laStation): static
    {
        $this->laStation = $laStation;

        return $this;
    }

    public function getLeTechnicien(): ?Technicien
    {
        return $this->leTechnicien;
    }

    public function setLeTechnicien(?Technicien $leTechnicien): static
    {
        $this->leTechnicien = $leTechnicien;

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

    public static  function Visite($lesBornesAVisiter, $uneStation) 
    
    {
        $instance = new self();
        $instance->lesBornes = $lesBornesAVisiter;
        $instance->laStation = $uneStation;
        $instance->état = 'p'; // Initialiser à 'p' pour programmée

        // Calculer la durée totale en fonction des bornes à visiter
        $instance->dureeTotale = 0;
        foreach ($instance->lesBornes as $borne) {
            $instance->dureeTotale += $borne->getDureeRevision();
        }
        return $instance;
    }

    public function changerEtat() {
        switch ($this->etat) {
            case 'p': // Si l'état est 'programmée'
                $this->etat = 'a'; // Passer à 'affectée'
                break;
            case 'a': // Si l'état est 'affectée'
                $this->etat = 'r'; // Passer à 'réalisée'
                break;
            default:
                // Vous pouvez gérer des erreurs ou des cas non pris en charge ici, si nécessaire
                break;
        }
    }

    public function affecterVisite($uneVisite) {
        $this->lesVisites[] = $uneVisite; // Ajoute la visite à la collection des visites affectées
        $uneVisite->changerEtat(); // Change l'état de la visite pour refléter qu'elle a été affectée
    }

}

