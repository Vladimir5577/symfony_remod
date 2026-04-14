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
            $levels = $p->getLevels();

            return [
                'id'          => $p->getId(),
                'slug'        => $p->getSlug(),
                'name'        => $p->getName(),
                'sub'         => $p->getSub(),
                'description' => $p->getDescription(),
                'forWho'      => $this->normalizeStringList($p->getForWho()),
                'includes'    => $this->normalizeStringList($p->getIncludes()),
                'levels'      => null === $levels ? null : $this->normalizeStringList($levels),
                'price'       => $p->getPrice(),
                'featured'    => $p->isFeatured(),
                'image'       => $img,
            ];
        }, $items);
        return $this->json($data);
    }

    /** @param mixed $raw */
    private function normalizeStringList(mixed $raw): array
    {
        if (null === $raw) {
            return [];
        }
        if (\is_string($raw)) {
            $t = trim($raw);
            if ('' === $t) {
                return [];
            }
            $decoded = json_decode($t, true);
            if (\JSON_ERROR_NONE === json_last_error() && \is_array($decoded)) {
                return $this->normalizeStringList($decoded);
            }

            return [$raw];
        }
        if (!\is_array($raw)) {
            return [];
        }
        $out = [];
        foreach ($raw as $item) {
            if (\is_string($item) && '' !== $item) {
                $out[] = $item;
            } elseif (\is_scalar($item) && '' !== (string) $item) {
                $out[] = (string) $item;
            }
        }

        return array_values($out);
    }
}
