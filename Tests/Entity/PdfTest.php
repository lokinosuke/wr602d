<?php
// tests/Entity/PdfTest.php
namespace App\Tests\Entity;

use App\Entity\PDF;
use PHPUnit\Framework\TestCase;

class PdfTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $pdf = new PDF();

        // Définition de données de test
        $createdAt = new \DateTimeImmutable();

        // Utilisation des setters
        $pdf->setCreatedAt($createdAt);

        // Vérification des getters
        $this->assertEquals($createdAt, $pdf->getCreatedAt());

    }
}