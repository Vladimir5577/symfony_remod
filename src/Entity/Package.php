<?php

namespace App\Entity;

use App\Repository\PackageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PackageRepository::class)]
#[Vich\Uploadable]
class Package
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** white-box | belyy | seryy */
    #[ORM\Column(length: 50, unique: true)]
    private string $slug = '';

    #[ORM\Column(length: 100)]
    private string $name = '';

    /** Подзаголовок: "Черновая отделка" */
    #[ORM\Column(length: 150)]
    private string $sub = '';

    #[ORM\Column(type: 'text')]
    private string $description = '';

    /** @var string[] */
    #[ORM\Column(type: 'json')]
    private array $forWho = [];

    /** @var string[] */
    #[ORM\Column(type: 'json')]
    private array $includes = [];

    /** @var string[] — например ["Эконом","Комфорт","Комфорт+"] или null */
    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $levels = null;

    #[ORM\Column(length: 50)]
    private string $price = '';

    #[ORM\Column(options: ['default' => false])]
    private bool $featured = false;

    #[Vich\UploadableField(mapping: 'package_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(options: ['default' => 0])]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }

    public function getSlug(): string { return $this->slug; }
    public function setSlug(string $slug): static { $this->slug = $slug; return $this; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getSub(): string { return $this->sub; }
    public function setSub(string $sub): static { $this->sub = $sub; return $this; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): static { $this->description = $description; return $this; }

    public function getForWho(): array { return $this->forWho; }
    public function setForWho(array $forWho): static { $this->forWho = $forWho; return $this; }

    public function getIncludes(): array { return $this->includes; }
    public function setIncludes(array $includes): static { $this->includes = $includes; return $this; }

    public function getLevels(): ?array { return $this->levels; }
    public function setLevels(?array $levels): static { $this->levels = $levels; return $this; }

    public function getPrice(): string { return $this->price; }
    public function setPrice(string $price): static { $this->price = $price; return $this; }

    public function isFeatured(): bool { return $this->featured; }
    public function setFeatured(bool $featured): static { $this->featured = $featured; return $this; }

    public function getImageFile(): ?File { return $this->imageFile; }
    public function setImageFile(?File $file): static
    {
        $this->imageFile = $file;
        if ($file) { $this->updatedAt = new \DateTimeImmutable(); }
        return $this;
    }

    public function getImageName(): ?string { return $this->imageName; }
    public function setImageName(?string $name): static { $this->imageName = $name; return $this; }

    public function getUpdatedAt(): ?\DateTimeImmutable { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeImmutable $dt): static { $this->updatedAt = $dt; return $this; }

    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $sortOrder): static { $this->sortOrder = $sortOrder; return $this; }

    public function __toString(): string { return $this->name; }
}
