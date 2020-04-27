<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Advertisement;
use App\Form\AdvertisementType;
use App\Repository\AdvertisementRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function advertisementForm($slug = false , Request $request, AdvertisementRepository $adRepo)
    {
        $formMethod = $slug ? 'Modifier' : 'Créer';

        $advertisement = $slug ? $adRepo->findOneBySlug($slug) : new Advertisement();

        $form =$this->createForm(AdvertisementType::class, $advertisement);

        $form->handleRequest($request);
        $manager = $this->getDoctrine()->getManager();
        
        if($form->isSubmitted() && $form->isValid()) {
            foreach($advertisement->getPictures() as $picture) {
                $picture->setAdvertisement($advertisement);
                $manager->persist($picture);
            }
            
            $manager->persist($advertisement);

            $manager->flush();

            $flashMethod = $slug ? 'Modifié' : 'Créé';

            $this->addFlash(
                'success',
                "L'annonce {$advertisement->getTitle()} a bien été {$flashMethod}"
            );

            return $this->redirectToRoute('advertisement_show', ['slug' => $advertisement->getSlug() ]);
        }

        return $this->render('advertisement/form.html.twig', [
            'formMethod' => $formMethod,
            'form' => $form->createView()
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
