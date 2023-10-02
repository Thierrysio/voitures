<?php

namespace App\Entity;
use App\Entity\Rouleau;
use App\Repository\SlotMachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlotMachineRepository::class)]
class SlotMachine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'leSlotMachine', targetEntity: Rouleau::class)]
    private Collection $lesRouleaux;

    public function __construct()
    {
        $this->lesRouleaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Rouleau>
     */
    public function getLesRouleaux(): Collection
    {
        return $this->lesRouleaux;
    }

    public function addLesRouleaux(Rouleau $lesRouleaux): static
    {
        if (!$this->lesRouleaux->contains($lesRouleaux)) {
            $this->lesRouleaux->add($lesRouleaux);
            $lesRouleaux->setLeSlotMachine($this);
        }

        return $this;
    }

    public function removeLesRouleaux(Rouleau $lesRouleaux): static
    {
        if ($this->lesRouleaux->removeElement($lesRouleaux)) {
            // set the owning side to null (unless already changed)
            if ($lesRouleaux->getLeSlotMachine() === $this) {
                $lesRouleaux->setLeSlotMachine(null);
            }
        }

        return $this;
    }

    public function jouer() {
        $results = [];
        for ($i = 0; $i < 3; $i++) {
            $results[] = $this->lesRouleaux[$i]->tourner();
        }
        return $results;
    }

    public function calculerGain(array $results) {
        if ($results[0] === $results[1] && $results[1] === $results[2]) {
            return 50; // gain pour 3 numéros identiques
        } elseif ($results[0] === $results[1] || $results[1] === $results[2] || $results[0] === $results[2]) {
            return 20; // gain pour 2 numéros identiques
        }
        return 0; // aucun gain
    }
    
}
