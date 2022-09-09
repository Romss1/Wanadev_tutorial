<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\VideoGameEntity;
use App\Repository\VideoGameRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateVideoGameTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $doctrine;
    private VideoGameEntity $entityToClear;
    private VideoGameRepository $repository;

    protected function setUp(): void
    {
        $this->client = self::createClient();
        $this->doctrine = $this->requireDoctrine();
        $this->repository = $this->requireRepository();
    }

    /*
     * Quand je fait un appel POST sur l'url /video-game
     * Et que je spécifie le titre "X-com: Ennemy Unknown"
     * Et que je spécifie....
     * Alors l'application me répond qu'il a été créé
     * Et il existe alors en BDD un jeux vidéo qui s'appelle "X-com: Ennemy Unknown"
     */
    public function testPostVideoGameWithTitle(): void
    {
        $date = (new DateTimeImmutable())->setDate(2022, 9, 9);
        $this->client->jsonRequest(
            'POST',
            '/video-game',
            [
                'title' => 'X-com: Ennemy Unknown',
                'releaseDate' => '2022-09-09',
                'websiteUrl' => 'https://X-com-çaàpaslairtop.com',
                'note' => 12,
                'completed' => true,
            ]
        );

        $statusCode = $this->client->getResponse()->getStatusCode();
        self::assertEquals(204, $statusCode);

        $videoGame = $this->repository->findBy([
            'title' => 'X-com: Ennemy Unknown',
            'releaseDate' => $date,
            'websiteUrl' => 'https://X-com-çaàpaslairtop.com',
            'note' => 12,
            'completed' => true,
        ]);
        $this->entityToClear = $videoGame[0];
        self::assertInstanceOf(VideoGameEntity::class, $this->entityToClear);
    }

    private function requireDoctrine(): EntityManagerInterface
    {
        $doctrine = $this->getContainer()->get(EntityManagerInterface::class);
        if (!$doctrine instanceof EntityManagerInterface) {
            $this->fail('Failed to load doctrine');
        }

        return $doctrine;
    }

    private function requireRepository(): VideoGameRepository
    {
        $repository = $this->getContainer()->get(VideoGameRepository::class);
        if (!$repository instanceof VideoGameRepository) {
            $this->fail('Failed to load Repository');
        }

        return $repository;
    }

    protected function tearDown(): void
    {
        $entity = $this->repository->findBy(['title' => $this->entityToClear->getTitle()]);
        $this->doctrine->remove($entity[0]);
        $this->doctrine->flush();
    }
}
