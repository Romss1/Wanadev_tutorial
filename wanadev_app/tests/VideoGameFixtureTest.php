<?php

declare(strict_types=1);

namespace App\Tests;

use App\Repository\VideoGameRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VideoGameFixtureTest extends WebTestCase
{
    private VideoGameRepository $repository;

    public function testVideoGameAreLoaded(): void
    {
        $this->repository = $this->requireVideoGameRepository();
        $videoGames = $this->repository->findAll();
        self::assertCount(10, $videoGames);
    }

    private function requireVideoGameRepository(): VideoGameRepository
    {
        $repository = $this->getContainer()->get(VideoGameRepository::class);
        if (!$repository instanceof VideoGameRepository) {
            $this->fail('Failed to load VideoGameRepository');
        }

        return $repository;
    }
}
