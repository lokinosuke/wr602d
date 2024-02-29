<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\PDFRepository;

class ProfileController extends AbstractController
{
    private $pdfRepository;

    public function __construct(PDFRepository $pdfRepository)
    {
        $this->pdfRepository = $pdfRepository;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser();
        $username = $user->getFirstname();
        $subscription = $user->getSubs();
        $subscriptionTitle = $subscription->getTitle();
        $pdfLimit = $subscription->getLimitsPdf();
        
        // Get the count of PDFs made today by the user
        $startOfDay = new \DateTime('today');
        $endOfDay = new \DateTime('tomorrow');
        $pdfCountToday = $this->pdfRepository->countPdfGeneratedByUserOnDate($user->getId(), $startOfDay, $endOfDay);

        // Check if the user has exceeded the PDF limit
        $pdfLimitExceeded = $pdfCountToday >= $pdfLimit;

        // Get the titles of the PDFs made by the user
        $pdfTitles = $this->pdfRepository->findTitlesByUser($user->getId());
        
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'username' => $username,
            'subscription_title' => $subscriptionTitle,
            'pdf_count_today' => $pdfCountToday,
            'pdf_limit' => $pdfLimit,
            'pdf_limit_exceeded' => $pdfLimitExceeded,
            'pdf_titles' => $pdfTitles,
        ]);
    }
}