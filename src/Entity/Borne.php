<?php

namespace App\Entity;

use App\Repository\BorneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorneRepository::class)]
class Borne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $idBorne = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDerniereRevision = null;

    #[ORM\Column]
    private ?int $indiceCompteurUnites = null;

    #[ORM\ManyToOne(inversedBy: 'lesBornes')]
    private ?Visite $laVisite = null;

    #[ORM\ManyToOne(inversedBy: 'lesBornes')]
    private ?TypeBorne $leType = null;

    #[ORM\ManyToOne(inversedBy: 'lesBornes')]
    private ?Station $laStation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBorne(): ?int
    {
        return $this->idBorne;
    }

    public function setIdBorne(?int $idBorne): static
    {
        $this->idBorne = $idBorne;

        return $this;
    }

    public function getDateDerniereRevision(): ?\DateTimeInterface
    {
        return $this->dateDerniereRevision;
    }

    public function setDateDerniereRevision(\DateTimeInterface $dateDerniereRevision): static
    {
        $this->dateDerniereRevision = $dateDerniereRevision;

        return $this;
    }

    public function getIndiceCompteurUnites(): ?int
    {
        return $this->indiceCompteurUnites;
    }

    public function setIndiceCompteurUnites(int $indiceCompteurUnites): static
    {
        $this->indiceCompteurUnites = $indiceCompteurUnites;

        return $this;
    }

    public function getLaVisite(): ?Visite
    {
        return $this->laVisite;
    }

    public function setLaVisite(?Visite $laVisite): static
    {
        $this->laVisite = $laVisite;

        return $this;
    }

    public function getLeType(): ?TypeBorne
    {
        return $this->leType;
    }

    public function setLeType(?TypeBorne $leType): static
    {
        $this->leType = $leType;

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
    public function getDureeRevision() : ?int 
    {
        // Retourne la durée de révision basée sur le type de la borne
        return $this->leType->getDureeRevision();
    }

    public function estAReviser() {
        // Vérifier sur la base du temps écoulé depuis la dernière révision
        $dateActuelle = new DateTime();
        $interval = $dateActuelle->diff($this->dateDerniereRevision);
        $joursEcoules = $interval->days;
        if ($joursEcoules >= $this->leType->getNbJoursEntreRevisions()) {
            return true;
        }

        // Vérifier sur la base du nombre d'unités de recharge délivrées
        if ($this->indiceCompteurUnites >= $this->leType->getNbUnitesEntreRevisions()) {
            return true;
        }

        // Si aucun des critères ci-dessus n'est rempli, la borne n'a pas besoin d'être révisée
        return false;
    }
}
