<?php

namespace App\DataFixtures;

use App\Entity\VideoGameEntity;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class VideoGameFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $faker = FakerFactory::create();
            $videoGame = new VideoGameEntity($faker->name(), DateTimeImmutable::createFromMutable($faker->dateTime()), $faker->url(), $faker->numberBetween(0, 20), $faker->boolean());
            $manager->persist($videoGame);
        }

        $manager->flush();
    }
}
