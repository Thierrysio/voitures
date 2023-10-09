<?php

namespace App\Entity;

use App\Repository\MaintenanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaintenanceRepository::class)]
class Maintenance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'laMaintenance', targetEntity: Visite::class)]
    private Collection $lesVisites;

    #[ORM\OneToMany(mappedBy: 'laMaintenance', targetEntity: Technicien::class)]
    private Collection $lesTechniciens;

    public function __construct()
    {
        $this->lesVisites = new ArrayCollection();
        $this->lesTechniciens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $lesVisite->setLaMaintenance($this);
        }

        return $this;
    }

    public function removeLesVisite(Visite $lesVisite): static
    {
        if ($this->lesVisites->removeElement($lesVisite)) {
            // set the owning side to null (unless already changed)
            if ($lesVisite->getLaMaintenance() === $this) {
                $lesVisite->setLaMaintenance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Technicien>
     */
    public function getLesTechniciens(): Collection
    {
        return $this->lesTechniciens;
    }

    public function addLesTechnicien(Technicien $lesTechnicien): static
    {
        if (!$this->lesTechniciens->contains($lesTechnicien)) {
            $this->lesTechniciens->add($lesTechnicien);
            $lesTechnicien->setLaMaintenance($this);
        }

        return $this;
    }

    public function removeLesTechnicien(Technicien $lesTechnicien): static
    {
        if ($this->lesTechniciens->removeElement($lesTechnicien)) {
            // set the owning side to null (unless already changed)
            if ($lesTechnicien->getLaMaintenance() === $this) {
                $lesTechnicien->setLaMaintenance(null);
            }
        }

        return $this;
    }

    public function affecterVisites() {
        // Pour chaque visite à réaliser
        foreach ($this->lesVisites as $visite) {
            // Trouver le technicien le moins occupé
            usort($this->lesTechniciens, function($a, $b) {
                return $a->getTempsOccupe() - $b->getTempsOccupe();
            });

            // Affecter la visite au technicien le moins occupé
            $technicienLeMoinsOccupe = $this->lesTechniciens[0];
            $technicienLeMoinsOccupe->affecterVisite($visite);

            // Dans la méthode affecterVisite, l'état de la visite est changé à 'affectée'
        }
    }
}
