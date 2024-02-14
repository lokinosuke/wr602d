<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Subscription;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subscription = new Subscription();
        $subscription->setTitle('Free');
        $subscription->setDescription('Free subscription');
        $subscription->setPrice(0);
        $subscription->setMedia('/images/basic.svg');
        $subscription->setLimitsPdf(3);
        $manager->persist($subscription);
        $manager->flush();

        $subscription = new Subscription();
        $subscription->setTitle('Basic');
        $subscription->setDescription('Basic subscription');
        $subscription->setPrice(9.99);
        $subscription->setMedia('/images/basic.svg');
        $subscription->setLimitsPdf(10);
        $manager->persist($subscription);
        $manager->flush();

        $subscription = new Subscription();
        $subscription->setTitle('Premium');
        $subscription->setDescription('Premium subscription');
        $subscription->setPrice(29.99);
        $subscription->setMedia('/images/basic.svg');
        $subscription->setLimitsPdf(30);
        $manager->persist($subscription);
        $manager->flush();

    }
}