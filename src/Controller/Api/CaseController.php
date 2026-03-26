<?php

namespace App\Controller\Api;

use App\Repository\RenovationCaseRepository;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route('/api/cases', name: 'api_cases_')]
class CaseController extends AbstractController
{
    public function __construct(
        private RenovationCaseRepository $caseRepo,
        private UploaderHelper $uploaderHelper,
        private CacheManager $imagineCacheManager,
    ) {}

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $cases = $this->caseRepo->findAllOrdered();
        $data = array_map(fn($c) => $this->serializeCase($c, false), $cases);
        return $this->json($data);
    }

    #[Route('/{slug}', name: 'detail', methods: ['GET'])]
    public function detail(string $slug): JsonResponse
    {
        $c = $this->caseRepo->findOneBy(['slug' => $slug]);
        if (!$c) {
            return $this->json(['error' => 'Not found'], 404);
        }
        return $this->json($this->serializeCase($c, true));
    }

    private function serializeCase(\App\Entity\RenovationCase $c, bool $withGallery): array
    {
        $imgBefore = null;
        $imgAfter = null;

        if ($c->getImgBeforeName()) {
            $path = $this->uploaderHelper->asset($c, 'imgBeforeFile');
            $imgBefore = $this->imagineCacheManager->getBrowserPath($path, 'case_card');
        }
        if ($c->getImgAfterName()) {
            $path = $this->uploaderHelper->asset($c, 'imgAfterFile');
            $imgAfter = $this->imagineCacheManager->getBrowserPath($path, 'case_card');
        }

        $result = [
            'id'        => $c->getId(),
            'slug'      => $c->getSlug(),
            'title'     => $c->getTitle(),
            'area'      => $c->getArea(),
            'type'      => $c->getType(),
            'pkg'       => $c->getPkg(),
            'days'      => $c->getDays(),
            'year'      => $c->getYear(),
            'summary'   => $c->getSummary(),
            'imgBefore' => $imgBefore,
            'imgAfter'  => $imgAfter,
            'challenges' => $c->getChallenges(),
        ];

        if ($withGallery) {
            $gallery = [];
            foreach ($c->getGalleryImages() as $img) {
                if ($img->getImageName()) {
                    $path = $this->uploaderHelper->asset($img, 'imageFile');
                    $gallery[] = $this->imagineCacheManager->getBrowserPath($path, 'case_gallery_thumb');
                }
            }
            $result['gallery'] = $gallery;
        }

        return $result;
    }
}
