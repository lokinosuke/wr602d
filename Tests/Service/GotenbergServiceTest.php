<?php
namespace App\Tests\Service;

use App\Service\GotenbergService;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class GotenbergServiceTest extends TestCase
{
    public function testGeneratePdfFromUrl(): void
    {
        // Création d'un client HTTP mock

        $httpClient = new MockHttpClient([
            new MockResponse('PDF content'),
        ]);

        // Instanciation du service SymfonyDocs avec le client HTTP mock
        $symfonyDocsService = new GotenbergService($httpClient);

        // Appel de la méthode pour générer un PDF à partir d'une URL
        $pdfFilePath = $symfonyDocsService->generatePdfFromUrl('https://example.com/');

        // Vérification que le chemin du fichier PDF est retourné
        $this->assertStringEndsWith('.pdf', $pdfFilePath);
        $this->assertFileExists($pdfFilePath);

        // Suppression du fichier PDF créé
        unlink($pdfFilePath);
    }
}