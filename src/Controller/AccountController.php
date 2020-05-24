<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\PasswordChange;
use App\Form\RegistrationType;
use App\Form\PasswordChangeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * @Route("/logout", name="account_logout")
     */
    public function logout()
    {

    }

    /**
     * @Route("/register", name="account_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $manager = $this->getDoctrine()->getManager();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre compte a bien été créé !'
            );

            return $this->redirectToRoute('account_login');
        }

        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/profile", name="account_edit_profile")
     */
    public function editProfile(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'le profile a été mis a jour'
            );
        }

        return $this->render('account/editProfile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @route(path="/account/password-change", name="account_password")
     */
    public function passwordChange()
    {
        $passwordChange = new PasswordChange();

        $form = $this->createForm(PasswordChangeType::class, $passwordChange);
        
        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
