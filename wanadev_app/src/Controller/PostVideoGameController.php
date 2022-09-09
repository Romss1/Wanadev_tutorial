<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\VideoGameEntity;
use App\Repository\VideoGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class PostVideoGameController extends AbstractController
{
    private SerializerInterface $serializer;
    private VideoGameRepository $videoGameRepository;

    public function __construct(SerializerInterface $serializer, VideoGameRepository $videoGameRepository)
    {
        $this->serializer = $serializer;
        $this->videoGameRepository = $videoGameRepository;
    }

    public function __invoke(Request $request): Response
    {
        $content = $request->getContent();
//        dd($content);
        $object = $this->serializer->deserialize($content, VideoGameEntity::class, 'json');
        $this->videoGameRepository->save($object);

        return new Response(null, 204);
    }
}
