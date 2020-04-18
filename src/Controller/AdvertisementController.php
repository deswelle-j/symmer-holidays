<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdvertisementController extends AbstractController
{
    /**
     * @Route("/advertisement", name="advertisement")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AdvertisementController.php',
        ]);
    }
}
