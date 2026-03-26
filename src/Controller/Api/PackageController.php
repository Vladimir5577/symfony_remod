<?php

namespace App\Controller\Api;

use App\Repository\PackageRepository;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route('/api/packages', name: 'api_packages_')]
class PackageController extends AbstractController
{
    public function __construct(
        private PackageRepository $repo,
        private UploaderHelper $uploaderHelper,
        private CacheManager $imagineCacheManager,
    ) {}

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $items = $this->repo->findAllOrdered();
        $data = array_map(function($p) {
            $img = null;
            if ($p->getImageName()) {
                $path = $this->uploaderHelper->asset($p, 'imageFile');
                $img = $this->imagineCacheManager->getBrowserPath($path, 'package_card');
            }
            return [
                'id'          => $p->getId(),
                'slug'        => $p->getSlug(),
                'name'        => $p->getName(),
                'sub'         => $p->getSub(),
                'description' => $p->getDescription(),
                'forWho'      => $p->getForWho(),
                'includes'    => $p->getIncludes(),
                'levels'      => $p->getLevels(),
                'price'       => $p->getPrice(),
                'featured'    => $p->isFeatured(),
                'image'       => $img,
            ];
        }, $items);
        return $this->json($data);
    }
}
