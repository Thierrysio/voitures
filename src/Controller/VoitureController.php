<?php

namespace App\Controller;
use App\Entity\modele;
use App\Entity\option;
use App\Entity\Marque;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function index(): Response
    {
        return $this->render('voiture/index.html.twig', [
            'controller_name' => 'VoitureController',
        ]);
    }

    #[Route('/GetListeVoitures', name: 'app_ListeVoitures')]
    public function ListeVoitures(VoitureRepository $VoitureRepository ): Response
    {
        $ListeVoitures = $VoitureRepository->GetListeVoitures();
        return $this->render('voiture/ListeVoitures.html.twig', [
            'ListeVoitures' => $ListeVoitures,
        ]);
    }
}
