<?php

namespace App\Controller\Api;

use App\Entity\Lead;
use App\Service\LeadMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/leads', name: 'api_leads_')]
class LeadController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private LeadMailer $leadMailer,
    ) {}

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        if (!$body) {
            return $this->json(['error' => 'Invalid JSON'], 400);
        }

        $lead = new Lead();
        $lead->setType($body['type'] ?? 'QUIZ');
        $lead->setPropertyType($body['propertyType'] ?? null);
        $lead->setArea($body['area'] ?? null);
        $lead->setPackage($body['package'] ?? null);
        $lead->setTimeframe($body['timeframe'] ?? null);
        $lead->setName($body['name'] ?? null);
        $lead->setPhone($body['phone'] ?? null);

        $this->em->persist($lead);
        $this->em->flush();

        $this->leadMailer->sendNewLeadNotification($lead);

        return $this->json(['ok' => true, 'id' => $lead->getId()], 201);
    }
}
