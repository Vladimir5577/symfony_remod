<?php

namespace App\Entity;

use App\Repository\SiteContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Синглтон — одна запись с контактами компании.
 */
#[ORM\Entity(repositoryClass: SiteContactRepository::class)]
class SiteContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private string $phone = '';

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $whatsapp = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $telegram = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $city = null;

    /** Часы работы Пн–Пт */
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $hoursWeekday = null;

    /** Часы работы Сб */
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $hoursSaturday = null;

    /** Часы работы Вс */
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $hoursSunday = null;

    public function getId(): ?int { return $this->id; }

    public function getPhone(): string { return $this->phone; }
    public function setPhone(string $phone): static { $this->phone = $phone; return $this; }

    public function getWhatsapp(): ?string { return $this->whatsapp; }
    public function setWhatsapp(?string $whatsapp): static { $this->whatsapp = $whatsapp; return $this; }

    public function getTelegram(): ?string { return $this->telegram; }
    public function setTelegram(?string $telegram): static { $this->telegram = $telegram; return $this; }

    public function getAddress(): ?string { return $this->address; }
    public function setAddress(?string $address): static { $this->address = $address; return $this; }

    public function getCity(): ?string { return $this->city; }
    public function setCity(?string $city): static { $this->city = $city; return $this; }

    public function getHoursWeekday(): ?string { return $this->hoursWeekday; }
    public function setHoursWeekday(?string $h): static { $this->hoursWeekday = $h; return $this; }

    public function getHoursSaturday(): ?string { return $this->hoursSaturday; }
    public function setHoursSaturday(?string $h): static { $this->hoursSaturday = $h; return $this; }

    public function getHoursSunday(): ?string { return $this->hoursSunday; }
    public function setHoursSunday(?string $h): static { $this->hoursSunday = $h; return $this; }

    public function __toString(): string { return $this->phone; }
}
