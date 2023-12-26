<?php

namespace App\DataFixtures;
use App\Entity\Bottle;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class BottleFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $bottle = new Bottle();
        $bottle->setName('Chablis');
        $bottle->setYear( DateTime::createFromFormat('Y', 1964));

        $bottle->setStorage($this->getReference(StorageFixture::STORAGE_ETAGE_1));
        $bottle->setRegion($this->getReference('REGION_BOURGOGNE'));
        $bottle->setType($this->getReference('TYPE_VIN BLANC'));
        
        $manager->persist($bottle);

        $manager->flush();
    }

    public function getDependencies(): array 
    {
        return [
            RegionFixtures::class,
            StorageFixture::class,
            TypeFixture::class,
        ];
    }
}
