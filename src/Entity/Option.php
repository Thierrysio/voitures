<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: '`option`')]
class Option
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToMany(targetEntity: Voiture::class, mappedBy: 'lesOptions')]
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getLesVoitures(): Collection
    {
        return $this->lesVoitures;
    }

    public function addLesVoiture(Voiture $lesVoiture): static
    {
        if (!$this->lesVoitures->contains($lesVoiture)) {
            $this->lesVoitures->add($lesVoiture);
            $lesVoiture->addLesOption($this);
        }

        return $this;
    }

    public function removeLesVoiture(Voiture $lesVoiture): static
    {
        if ($this->lesVoitures->removeElement($lesVoiture)) {
            $lesVoiture->removeLesOption($this);
        }

        return $this;
    }
}
