<?php

namespace App\DataFixtures;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class TypeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $types = [
            "Vin blanc",
            "Vin rouge",
            "Vin rose",
            "Vin mousseux"
        ];

        foreach ($types as $name) {
            $type = new Type();
            $type->setName($name);
            $manager->persist($type);
            $this->addReference('TYPE_'.strtoupper($name), $type);
        }
        $manager->flush();
    }
}
