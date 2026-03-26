<?php

namespace App\Controller\Api;

use App\Repository\FaqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/faqs', name: 'api_faqs_')]
class FaqController extends AbstractController
{
    public function __construct(
        private FaqRepository $repo,
    ) {}

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $items = $this->repo->findAllActive();
        $data = array_map(fn($f) => [
            'id'       => $f->getId(),
            'question' => $f->getQuestion(),
            'answer'   => $f->getAnswer(),
        ], $items);
        return $this->json($data);
    }
}
