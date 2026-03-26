<?php

namespace App\Entity;

use App\Repository\CaseGalleryImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CaseGalleryImageRepository::class)]
#[Vich\Uploadable]
class CaseGalleryImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: RenovationCase::class, inversedBy: 'galleryImages')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?RenovationCase $renovationCase = null;

    #[Vich\UploadableField(mapping: 'case_gallery', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(options: ['default' => 0])]
    private int $sortOrder = 0;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int { return $this->id; }

    public function getRenovationCase(): ?RenovationCase { return $this->renovationCase; }
    public function setRenovationCase(?RenovationCase $case): static { $this->renovationCase = $case; return $this; }

    public function getImageFile(): ?File { return $this->imageFile; }
    public function setImageFile(?File $file): static
    {
        $this->imageFile = $file;
        if ($file) { $this->updatedAt = new \DateTimeImmutable(); }
        return $this;
    }

    public function getImageName(): ?string { return $this->imageName; }
    public function setImageName(?string $name): static { $this->imageName = $name; return $this; }

    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $order): static { $this->sortOrder = $order; return $this; }

    public function getUpdatedAt(): ?\DateTimeImmutable { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeImmutable $dt): static { $this->updatedAt = $dt; return $this; }

    public function __toString(): string { return $this->imageName ?? ''; }
}
