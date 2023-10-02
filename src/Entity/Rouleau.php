<?php

namespace App\Entity;

use App\Repository\RouleauRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouleauRepository::class)]
class Rouleau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lesRouleaux')]
    private ?SlotMachine $leSlotMachine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeSlotMachine(): ?SlotMachine
    {
        return $this->leSlotMachine;
    }

    public function setLeSlotMachine(?SlotMachine $leSlotMachine): static
    {
        $this->leSlotMachine = $leSlotMachine;

        return $this;
    }
    public function tourner(): int {
        return rand(1, 9);
}
}