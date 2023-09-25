<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne]
    private ?marque $leMarque = null;

    #[ORM\OneToMany(mappedBy: 'lesModeles', targetEntity: voiture::class)]
    private Collection $lesVoitures;

    public function __construct()
    {
        $this->lesVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLeMarque(): ?marque
    {
        return $this->leMarque;
    }

    public function setLeMarque(?marque $leMarque): static
    {
        $this->leMarque = $leMarque;

        return $this;
    }

    /**
     * @return Collection<int, voiture>
     */
    public function getLesVoitures(): Collection
    {
        return $this->lesVoitures;
    }

    public function addLesVoiture(voiture $lesVoiture): static
    {
        if (!$this->lesVoitures->contains($lesVoiture)) {
            $this->lesVoitures->add($lesVoiture);
            $lesVoiture->setLesModeles($this);
        }

        return $this;
    }

    public function removeLesVoiture(voiture $lesVoiture): static
    {
        if ($this->lesVoitures->removeElement($lesVoiture)) {
            // set the owning side to null (unless already changed)
            if ($lesVoiture->getLesModeles() === $this) {
                $lesVoiture->setLesModeles(null);
            }
        }

        return $this;
    }
}
