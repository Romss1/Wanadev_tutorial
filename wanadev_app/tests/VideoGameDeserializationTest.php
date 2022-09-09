<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\VideoGameEntity;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\SerializerInterface;

class VideoGameDeserializationTest extends KernelTestCase
{
    public function testJsonVideoGameDeserialization(): void
    {
        $mySerialize = $this->getContainer()->get('serializer');
        if (!$mySerialize instanceof SerializerInterface) {
            $this->fail('error, because is null');
        }
        $data = '{ "title": "Call Of", "releaseDate": "2022-09-09", "websiteUrl": "https://www.test.com", "note": 15, "completed": false }';
        $videoGame = $mySerialize->deserialize($data, VideoGameEntity::class, 'json');

        $date = (new DateTimeImmutable())->setDate(2022, 9, 9);
        $date = $date->format('Y-m-d');
        $entityDate = $videoGame->getReleaseDate()->format('Y-m-d');
        self::assertInstanceOf(VideoGameEntity::class, $videoGame);
        self::assertEquals('Call Of', $videoGame->getTitle());
        self::assertEquals('https://www.test.com', $videoGame->getWebsiteUrl());
        self::assertEquals(15, $videoGame->getNote());
        self::assertIsBool($videoGame->isCompleted());
        self::assertEquals($date, $entityDate);
    }
}
