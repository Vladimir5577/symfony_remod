<?php

namespace App\Entity;

use App\Repository\RenovationCaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: RenovationCaseRepository::class)]
#[Vich\Uploadable]
class RenovationCase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    private string $slug = '';

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(length: 50)]
    private string $area = '';

    /** Новостройка | Вторичка | Студия */
    #[ORM\Column(length: 50)]
    private string $type = '';

    #[ORM\Column(length: 100)]
    private string $pkg = '';

    #[ORM\Column]
    private int $days = 0;

    #[ORM\Column]
    private int $year = 0;

    #[ORM\Column(type: 'text')]
    private string $summary = '';

    /** @var string[] */
    #[ORM\Column(type: 'json')]
    private array $challenges = [];

    // --- imgBefore ---
    #[Vich\UploadableField(mapping: 'case_before', fileNameProperty: 'imgBeforeName')]
    private ?File $imgBeforeFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgBeforeName = null;

    // --- imgAfter ---
    #[Vich\UploadableField(mapping: 'case_after', fileNameProperty: 'imgAfterName')]
    private ?File $imgAfterFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgAfterName = null;

    /** @var Collection<int, CaseGalleryImage> */
    #[ORM\OneToMany(targetEntity: CaseGalleryImage::class, mappedBy: 'renovationCase', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['sortOrder' => 'ASC'])]
    private Collection $galleryImages;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(options: ['default' => 0])]
    private int $sortOrder = 0;

    public function __construct()
    {
        $this->galleryImages = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getSlug(): string { return $this->slug; }
    public function setSlug(string $slug): static { $this->slug = $slug; return $this; }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): static { $this->title = $title; return $this; }

    public function getArea(): string { return $this->area; }
    public function setArea(string $area): static { $this->area = $area; return $this; }

    public function getType(): string { return $this->type; }
    public function setType(string $type): static { $this->type = $type; return $this; }

    public function getPkg(): string { return $this->pkg; }
    public function setPkg(string $pkg): static { $this->pkg = $pkg; return $this; }

    public function getDays(): int { return $this->days; }
    public function setDays(int $days): static { $this->days = $days; return $this; }

    public function getYear(): int { return $this->year; }
    public function setYear(int $year): static { $this->year = $year; return $this; }

    public function getSummary(): string { return $this->summary; }
    public function setSummary(string $summary): static { $this->summary = $summary; return $this; }

    public function getChallenges(): array { return $this->challenges; }
    public function setChallenges(array $challenges): static { $this->challenges = $challenges; return $this; }

    public function getImgBeforeFile(): ?File { return $this->imgBeforeFile; }
    public function setImgBeforeFile(?File $file): static
    {
        $this->imgBeforeFile = $file;
        if ($file) { $this->updatedAt = new \DateTimeImmutable(); }
        return $this;
    }

    public function getImgBeforeName(): ?string { return $this->imgBeforeName; }
    public function setImgBeforeName(?string $name): static { $this->imgBeforeName = $name; return $this; }

    public function getImgAfterFile(): ?File { return $this->imgAfterFile; }
    public function setImgAfterFile(?File $file): static
    {
        $this->imgAfterFile = $file;
        if ($file) { $this->updatedAt = new \DateTimeImmutable(); }
        return $this;
    }

    public function getImgAfterName(): ?string { return $this->imgAfterName; }
    public function setImgAfterName(?string $name): static { $this->imgAfterName = $name; return $this; }

    /** @return Collection<int, CaseGalleryImage> */
    public function getGalleryImages(): Collection { return $this->galleryImages; }

    public function addGalleryImage(CaseGalleryImage $image): static
    {
        if (!$this->galleryImages->contains($image)) {
            $this->galleryImages->add($image);
            $image->setRenovationCase($this);
        }
        return $this;
    }

    public function removeGalleryImage(CaseGalleryImage $image): static
    {
        if ($this->galleryImages->removeElement($image)) {
            if ($image->getRenovationCase() === $this) {
                $image->setRenovationCase(null);
            }
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeImmutable $dt): static { $this->updatedAt = $dt; return $this; }

    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $sortOrder): static { $this->sortOrder = $sortOrder; return $this; }

    public function __toString(): string { return $this->title; }
}
