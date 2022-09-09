<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\VideoGameEntity;
use App\Repository\VideoGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersistVideoGameTest extends KernelTestCase
{
    private VideoGameEntity $entityToClear;
    private VideoGameRepository $repository;
    private EntityManagerInterface $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->requireVideoGameRepository();
        $this->doctrine = $this->requireDoctrine();
    }

    private function requireVideoGameRepository(): VideoGameRepository
    {
        $repository = $this->getContainer()->get(VideoGameRepository::class);
        if (!$repository instanceof VideoGameRepository) {
            $this->fail('Failed to load VideoGameRepository');
        }

        return $repository;
    }

    private function requireDoctrine(): EntityManagerInterface
    {
        $doctrine = $this->getContainer()->get(EntityManagerInterface::class);
        if (!$doctrine instanceof EntityManagerInterface) {
            $this->fail('Failed to load doctrine');
        }

        return $doctrine;
    }

    public function testPersistVideoGameEntity(): void
    {
        $title = 'DeadCells';
        $releaseDate = new \DateTimeImmutable('2022-06-18');
        $websiteUrl = 'https://dead-cells.com/';
        $note = 3;
        $completed = true;
        $entity = $this->createVideoGame($title, $releaseDate, $websiteUrl, $note, $completed);

        $this->repository->save($entity);

        $this->entityToClear = $this->assertMatchingVideoGameExists($title, $releaseDate, $websiteUrl, $note, $completed);
    }

    private function createVideoGame(string $videoGameTitle, \DateTimeImmutable $videoGameReleaseDate, string $websiteUrl, int $note, bool $completed): VideoGameEntity
    {
        return new VideoGameEntity($videoGameTitle, $videoGameReleaseDate, $websiteUrl, $note, $completed);
    }

    private function assertMatchingVideoGameExists(string $videoGameTitle, \DateTimeImmutable $videoGameReleaseDate, string $websiteUrl, int $note, bool $completed): VideoGameEntity
    {
        $result = $this->repository->findBy([
            'title' => $videoGameTitle,
            'releaseDate' => $videoGameReleaseDate,
            'websiteUrl' => $websiteUrl,
            'note' => $note,
            'completed' => $completed,
        ]);
        $createdEntity = reset($result);
        if (!$createdEntity instanceof VideoGameEntity) {
            $this->fail('Failed to create entity');
        }
        self::assertInstanceOf(VideoGameEntity::class, $createdEntity);

        return $createdEntity;
    }

    protected function tearDown(): void
    {
        $this->doctrine->remove($this->entityToClear);
        $this->doctrine->flush();
    }
}
