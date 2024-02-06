<?php
// tests/Entity/SubscriptionTest.php
namespace App\Tests\Entity;

use App\Entity\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $subscription = new Subscription();

        // Définition de données de test
        $title = 'Test';
        $description = 'Test description';
        $media = 'Test media';
        $price = 10;
        $limitsPdf = 10;

        // Utilisation des setters
        $subscription->setTitle($title);
        $subscription->setDescription($description);
        $subscription->setMedia($media);
        $subscription->setPrice($price);
        $subscription->setLimitsPdf($limitsPdf);

        // Vérification des getters
        $this->assertEquals($title, $subscription->getTitle());
        $this->assertEquals($description, $subscription->getDescription());
        $this->assertEquals($media, $subscription->getMedia());
        $this->assertEquals($price, $subscription->getPrice());
        $this->assertEquals($limitsPdf, $subscription->getLimitsPdf());
    }
}