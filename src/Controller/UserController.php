<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route(path="/user/{slug}", name="user_profile")
     */

     public function profile(string $slug, UserRepository $userRepo)
     {
        $user = $userRepo->findOneBySlug($slug);

        return $this->render('account/profile.html.twig', [
            'user' => $user
        ]);
     }
}