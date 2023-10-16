<?php

namespace App\Tests;
use App\Entity\Visite;
use App\Entity\TypeBorne;
use App\Entity\Station;
use App\Entity\Borne;
use DateTime;
use PHPUnit\Framework\TestCase;

class BorneTest extends TestCase
{
    public function testEstAReviser()
    {
        // Créez une instance de TypeBorne pour la tester avec Borne
        $typeBorne = new TypeBorne(1, 30, 10, 50);  // Assumant que TypeBorne ait un constructeur approprié

        // Testons un cas où la borne doit être révisée en raison du temps
        $borne1 = new Borne(1, new DateTime('-11 days'), 25, $typeBorne); // Dernière révision il y a 11 jours
        
        $this->assertTrue($borne1->estAReviser());

        // Testons un cas où la borne doit être révisée en raison des unités
        $borne2 = new Borne(2, new DateTime('-5 days'), 55, $typeBorne); // 55 unités depuis la dernière révision
        $this->assertTrue($borne2->estAReviser());

        // Testons un cas où la borne ne doit pas être révisée
        $borne3 = new Borne(3, new DateTime('-5 days'), 25, $typeBorne); 
        $this->assertFalse($borne3->estAReviser());
    }
}
