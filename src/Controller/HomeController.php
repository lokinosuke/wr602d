<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\SubscriptionRepository;
use App\Form\SubscriptionType;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(UserInterface $user, SubscriptionRepository $subscriptionRepository, Request $request): Response
    {
        $subscriptions = $subscriptionRepository->findAll();

        // Handle form to update user subscription
        $form = $this->createForm(SubscriptionType::class, $user);
        $form->handleRequest($request);

        // Persist the changes
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'subscriptions' => $subscriptions,
            'form' => $form->createView(),
        ]);
    }
}