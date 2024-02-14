<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UserInterface $username): Response
    {
        $username = $this->getUser()->getFirstname();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'username' => $username,
        ]);
    }
}