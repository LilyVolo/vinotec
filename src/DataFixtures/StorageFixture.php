<?php

namespace App\DataFixtures;

use App\Entity\Storage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class StorageFixture extends Fixture
{
    public const STORAGE_ETAGE_1 = "STORAGE_ETAGE_1";

    public function load(ObjectManager $manager): void
    {
        $storage = new Storage();
        $storage->setName('Etage 1');
        $manager->persist($storage);
        $this->addReference(self::STORAGE_ETAGE_1, $storage);

        $storage = new Storage();
        $storage->setName('Etage 2');
        $manager->persist($storage);

        $storage = new Storage();
        $storage->setName('Etage 3');
        $manager->persist($storage);


        $manager->flush();
    }
}
