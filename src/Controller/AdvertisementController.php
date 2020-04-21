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


        return $this->render( 'advertisement/list.html.twig', [
            'advertisments' => $advertisements
        ]);
    }

    /**
     * @Route("/advertisement/new", name="advertisement_new")
     */
    public function new()
    {
        return $this->render('advertisement/show.html.twig', [
            'advertisement' => $advertisement
        ]);
    }

    /**
     * @Route("/advertisement/{slug}", name="advertisement_show")
     * 
     * @return Response
     */
    public function show( $slug, AdvertisementRepository $adRepo)
    {
        $advertisement =$adRepo->findOneBySlug($slug);
        return $this->render('advertisement/show.html.twig', [
            'advertisement' => $advertisement
        ]);
    }

    

}
