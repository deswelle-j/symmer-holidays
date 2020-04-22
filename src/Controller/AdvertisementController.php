<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Form\AdvertisementType;
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
     * @Route("/advertisement/{slug}/edit", name="advertisement_edit")
     */
    public function advertisementForm($slug = false)
    {
        $formMethod = $slug ? 'Modifier' : 'Créer';
        $advertisement = new Advertisement();

        $form =$this->createForm(AdvertisementType::class, $advertisement);


        return $this->render('advertisement/form.html.twig', [
            'formMethod' => $formMethod,
            'advertisementFrom' => $form->createView()
        ]);
    }

    /**
     * @Route("/advertisements", name="advertisement_list")
     */
    public function advertisements(AdvertisementRepository $adRepo)
    {
        $advertisements = $adRepo->findAll();

        return $this->render( 'advertisement/list.html.twig', [
            'advertisements' => $advertisements
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
