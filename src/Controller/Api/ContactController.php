<?php

namespace App\Controller\Api;

use App\Repository\SiteContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/contacts', name: 'api_contacts_')]
class ContactController extends AbstractController
{
    public function __construct(
        private SiteContactRepository $repo,
    ) {}

    #[Route('', name: 'get', methods: ['GET'])]
    public function get(): JsonResponse
    {
        $c = $this->repo->findOneBy([]);
        if (!$c) {
            return $this->json(null);
        }
        return $this->json([
            'phone'          => $c->getPhone(),
            'whatsapp'       => $c->getWhatsapp(),
            'telegram'       => $c->getTelegram(),
            'address'        => $c->getAddress(),
            'city'           => $c->getCity(),
            'hoursWeekday'   => $c->getHoursWeekday(),
            'hoursSaturday'  => $c->getHoursSaturday(),
            'hoursSunday'    => $c->getHoursSunday(),
        ]);
    }
}
