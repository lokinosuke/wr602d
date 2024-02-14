<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(UserInterface $username): Response
    {
        $username = $this->getUser()->getFirstname();
        $subscription = $this->getUser()->getSubs()->getTitle();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'username' => $username,
            'subscription' => $subscription,
        ]);
    }
}
