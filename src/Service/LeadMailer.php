<?php

namespace App\Service;

use App\Entity\Lead;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class LeadMailer
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig,
        private LoggerInterface $logger,
        private string $adminEmail,
        private string $mailerFrom,
    ) {}

    public function sendNewLeadNotification(Lead $lead): void
    {
        if (!$this->adminEmail) {
            return;
        }

        try {
            $html = $this->twig->render('email/lead_notification.html.twig', ['lead' => $lead]);

            $email = (new Email())
                ->from($this->mailerFrom)
                ->to($this->adminEmail)
                ->subject(sprintf('Новая заявка #%d с сайта', $lead->getId() ?? 0))
                ->html($html);

            $this->mailer->send($email);
        } catch (\Throwable $e) {
            $this->logger->error('Failed to send lead notification email', [
                'lead' => $lead->getId(),
                'error' => $e->getMessage(),
            ]);
        }
    }
}
