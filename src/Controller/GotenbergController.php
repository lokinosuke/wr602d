<?php

namespace App\Controller;

use App\Service\GotenbergService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GotenbergController extends AbstractController
{
    private GotenbergService $gotenbergService;

    public function __construct(GotenbergService $gotenbergService)
    {
        $this->gotenbergService = $gotenbergService;
    }

    #[Route('/gotenberg', name: 'app_gotenberg')]
    public function index(): Response
    {
        return $this->render('gotenberg/index.html.twig');
    }

    /**

    @throws \Exception
    @throws TransportExceptionInterface*/#[Route('/gotenberg/convert', name: 'app_gotenberg_convert', methods: ['POST'])]
public function convert(Request $request): Response{$url = $request->request->get('url');

    $pdfFilePath = $this->gotenbergService->generatePdfFromUrl($url);

    return $this->file($pdfFilePath);
}

}