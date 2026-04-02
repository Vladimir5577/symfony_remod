<?php

namespace App\Controller\Api;

use App\Entity\HomeHero;
use App\Repository\HomeHeroRepository;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route('/api/hero', name: 'api_hero_')]
class HeroController extends AbstractController
{
    public function __construct(
        private HomeHeroRepository $repo,
        private UploaderHelper $uploaderHelper,
        private CacheManager $imagineCacheManager,
    ) {}

    #[Route('', name: 'get', methods: ['GET'])]
    public function get(): JsonResponse
    {
        $hero = $this->repo->findOneBy([]);
        if (!$hero instanceof HomeHero) {
            return $this->json(null);
        }

        $imgBefore = null;
        $imgAfter = null;

        if ($hero->getImgBeforeName()) {
            $path = $this->uploaderHelper->asset($hero, 'imgBeforeFile');
            $imgBefore = $this->imagineCacheManager->getBrowserPath($path, 'hero_before');
        }
        if ($hero->getImgAfterName()) {
            $path = $this->uploaderHelper->asset($hero, 'imgAfterFile');
            $imgAfter = $this->imagineCacheManager->getBrowserPath($path, 'hero_after');
        }

        return $this->json([
            'imgBefore' => $imgBefore,
            'imgAfter' => $imgAfter,
        ]);
    }
}

