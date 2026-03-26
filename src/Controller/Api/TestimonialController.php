<?php

namespace App\Controller\Api;

use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/testimonials', name: 'api_testimonials_')]
class TestimonialController extends AbstractController
{
    public function __construct(
        private TestimonialRepository $repo,
    ) {}

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $items = $this->repo->findAllActive();
        $data = array_map(fn($t) => [
            'id'    => $t->getId(),
            'name'  => $t->getName(),
            'obj'   => $t->getObj(),
            'pkg'   => $t->getPkg(),
            'stars' => $t->getStars(),
            'quote' => $t->getQuote(),
        ], $items);
        return $this->json($data);
    }
}
