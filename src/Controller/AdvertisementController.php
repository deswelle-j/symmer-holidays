<?php

namespace App\Controller;

use App\Repository\AdvertisementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdvertisementController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            
        ]);
    }

    /**
     * @Route("/advertisements", name="advertisement_list")
     */
    public function advertisements(AdvertisementRepository $adRepo)
    {
        $advertisements = $adRepo->findAll();

        return $this->render( 'advertisement/list.html.twig', [
            'advertisments' => $advertisements
        ]);
    }
}
