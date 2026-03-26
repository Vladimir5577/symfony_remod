<?php

namespace App\Entity;

use App\Repository\TestimonialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestimonialRepository::class)]
class Testimonial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $name = '';

    /** Например: "Новостройка, 72 м²" */
    #[ORM\Column(length: 150)]
    private string $obj = '';

    #[ORM\Column(length: 100)]
    private string $pkg = '';

    #[ORM\Column(options: ['default' => 5])]
    private int $stars = 5;

    #[ORM\Column(type: 'text')]
    private string $quote = '';

    #[ORM\Column(options: ['default' => 0])]
    private int $sortOrder = 0;

    #[ORM\Column(options: ['default' => true])]
    private bool $active = true;

    public function getId(): ?int { return $this->id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getObj(): string { return $this->obj; }
    public function setObj(string $obj): static { $this->obj = $obj; return $this; }

    public function getPkg(): string { return $this->pkg; }
    public function setPkg(string $pkg): static { $this->pkg = $pkg; return $this; }

    public function getStars(): int { return $this->stars; }
    public function setStars(int $stars): static { $this->stars = $stars; return $this; }

    public function getQuote(): string { return $this->quote; }
    public function setQuote(string $quote): static { $this->quote = $quote; return $this; }

    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $sortOrder): static { $this->sortOrder = $sortOrder; return $this; }

    public function isActive(): bool { return $this->active; }
    public function setActive(bool $active): static { $this->active = $active; return $this; }

    public function __toString(): string { return $this->name; }
}
