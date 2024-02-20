<?php

namespace App\Controller;

use App\Service\GotenbergService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pdf;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use App\Repository\PDFRepository;
use App\Entity\User;
use App\Entity\Subscription;

class GotenbergController extends AbstractController
{
    private GotenbergService $gotenbergService;
    private EntityManagerInterface $entityManager;
    private PDFRepository $pdfRepository;

    public function __construct(GotenbergService $gotenbergService, EntityManagerInterface $entityManager, PDFRepository $pdfRepository)
    {
        $this->gotenbergService = $gotenbergService;
        $this->entityManager = $entityManager;
        $this->pdfRepository = $pdfRepository;
    }

    #[Route('/gotenberg', name: 'app_gotenberg')]
    public function index(): Response
    {
        // Vérification du nombre de PDFs générés aujourd'hui par l'utilisateur
        $startOfDay = new \DateTime('today');
        $endOfDay = new \DateTime('tomorrow');
        $pdfCountToday = $this->pdfRepository->countPdfGeneratedByUserOnDate($this->getUser()->getId(), $startOfDay, $endOfDay);
    
        // Vérifier si l'utilisateur a dépassé sa limite de PDF
        $pdfLimitExceeded = $pdfCountToday >= $this->getUser()->getSubs()->getLimitsPdf();
    
        // Passer la variable pdf_limit_exceeded à la vue Twig
        return $this->render('gotenberg/index.html.twig', [
            'pdf_limit_exceeded' => $pdfLimitExceeded,
        ]);
    }

    #[Route('/gotenberg/convert', name: 'app_gotenberg_convert', methods: ['POST'])]
    public function convert(Request $request, EntityManagerInterface $entityManager): Response {
        $url = $request->request->get('url');
        $pdfTitle = $request->request->get('title');
        $filepath = $this->gotenbergService->generatePdfFromUrl($url, $pdfTitle);

        //add pdf to bdd
        $pdf = new Pdf();
        $pdf->setUser($this->getUser());
        $pdf->setTitle($pdfTitle);
        $pdf->setFilepath('/uploads/' . $pdfTitle . '.pdf');
        $pdf->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($pdf);
        $entityManager->flush();

        return $this->file($filepath);
}
}

