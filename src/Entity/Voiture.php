<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne]
    private ?Modele $leModele = null;

    #[ORM\ManyToMany(targetEntity: option::class, inversedBy: 'lesVoitures')]
    private Collection $lesOptions;

    #[ORM\ManyToOne(inversedBy: 'lesVoitures')]
    private ?Modele $lesModeles = null;

    public function __construct()
    {
        $this->lesOptions = new ArrayCollection();
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

    public function getLeModele(): ?Modele
    {
        return $this->leModele;
    }

    public function setLeModele(?Modele $leModele): static
    {
        $this->leModele = $leModele;

        return $this;
    }

    /**
     * @return Collection<int, option>
     */
    public function getLesOptions(): Collection
    {
        return $this->lesOptions;
    }

    public function addLesOption(option $lesOption): static
    {
        if (!$this->lesOptions->contains($lesOption)) {
            $this->lesOptions->add($lesOption);
        }

        return $this;
    }

    public function removeLesOption(option $lesOption): static
    {
        $this->lesOptions->removeElement($lesOption);

        return $this;
    }

    public function getLesModeles(): ?Modele
    {
        return $this->lesModeles;
    }

    public function setLesModeles(?Modele $lesModeles): static
    {
        $this->lesModeles = $lesModeles;

        return $this;
    }
}
