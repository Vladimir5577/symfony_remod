<?php

namespace App\Entity;

use App\Repository\HomeHeroRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: HomeHeroRepository::class)]
#[Vich\Uploadable]
class HomeHero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(options: ['default' => true])]
    private bool $enabled = true;

    // --- Content (editable in admin) ---
    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $kickerText = '';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $titleTop = '';

    #[ORM\Column(type: 'text', options: ['default' => ''])]
    private string $titleAccent = '';

    #[ORM\Column(type: 'text', options: ['default' => ''])]
    private string $subtitleText = '';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $badgeText = '';

    #[ORM\Column(length: 50, options: ['default' => 'До'])]
    private string $beforeLabelText = 'До';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $primaryCtaText = '';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $primaryCtaUrl = '';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $secondaryCtaText = '';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $secondaryCtaUrl = '';

    #[ORM\Column(length: 100, options: ['default' => ''])]
    private string $utp1Label = '';

    #[ORM\Column(type: 'text', options: ['default' => ''])]
    private string $utp1Desc = '';

    #[ORM\Column(length: 100, options: ['default' => ''])]
    private string $utp2Label = '';

    #[ORM\Column(type: 'text', options: ['default' => ''])]
    private string $utp2Desc = '';

    #[ORM\Column(length: 100, options: ['default' => ''])]
    private string $utp3Label = '';

    #[ORM\Column(type: 'text', options: ['default' => ''])]
    private string $utp3Desc = '';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $beforeAlt = '';

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private string $afterAlt = '';

    // --- Images (Vich Uploader) ---
    #[Vich\UploadableField(mapping: 'hero_before', fileNameProperty: 'imgBeforeName')]
    private ?File $imgBeforeFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgBeforeName = null;

    #[Vich\UploadableField(mapping: 'hero_after', fileNameProperty: 'imgAfterName')]
    private ?File $imgAfterFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgAfterName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getKickerText(): string
    {
        return $this->kickerText;
    }

    public function setKickerText(string $kickerText): static
    {
        $this->kickerText = $kickerText;
        return $this;
    }

    public function getTitleTop(): string
    {
        return $this->titleTop;
    }

    public function setTitleTop(string $titleTop): static
    {
        $this->titleTop = $titleTop;
        return $this;
    }

    public function getTitleAccent(): string
    {
        return $this->titleAccent;
    }

    public function setTitleAccent(string $titleAccent): static
    {
        $this->titleAccent = $titleAccent;
        return $this;
    }

    public function getSubtitleText(): string
    {
        return $this->subtitleText;
    }

    public function setSubtitleText(string $subtitleText): static
    {
        $this->subtitleText = $subtitleText;
        return $this;
    }

    public function getBadgeText(): string
    {
        return $this->badgeText;
    }

    public function setBadgeText(string $badgeText): static
    {
        $this->badgeText = $badgeText;
        return $this;
    }

    public function getBeforeLabelText(): string
    {
        return $this->beforeLabelText;
    }

    public function setBeforeLabelText(string $beforeLabelText): static
    {
        $this->beforeLabelText = $beforeLabelText;
        return $this;
    }

    public function getPrimaryCtaText(): string
    {
        return $this->primaryCtaText;
    }

    public function setPrimaryCtaText(string $primaryCtaText): static
    {
        $this->primaryCtaText = $primaryCtaText;
        return $this;
    }

    public function getPrimaryCtaUrl(): string
    {
        return $this->primaryCtaUrl;
    }

    public function setPrimaryCtaUrl(string $primaryCtaUrl): static
    {
        $this->primaryCtaUrl = $primaryCtaUrl;
        return $this;
    }

    public function getSecondaryCtaText(): string
    {
        return $this->secondaryCtaText;
    }

    public function setSecondaryCtaText(string $secondaryCtaText): static
    {
        $this->secondaryCtaText = $secondaryCtaText;
        return $this;
    }

    public function getSecondaryCtaUrl(): string
    {
        return $this->secondaryCtaUrl;
    }

    public function setSecondaryCtaUrl(string $secondaryCtaUrl): static
    {
        $this->secondaryCtaUrl = $secondaryCtaUrl;
        return $this;
    }

    public function getUtp1Label(): string
    {
        return $this->utp1Label;
    }

    public function setUtp1Label(string $utp1Label): static
    {
        $this->utp1Label = $utp1Label;
        return $this;
    }

    public function getUtp1Desc(): string
    {
        return $this->utp1Desc;
    }

    public function setUtp1Desc(string $utp1Desc): static
    {
        $this->utp1Desc = $utp1Desc;
        return $this;
    }

    public function getUtp2Label(): string
    {
        return $this->utp2Label;
    }

    public function setUtp2Label(string $utp2Label): static
    {
        $this->utp2Label = $utp2Label;
        return $this;
    }

    public function getUtp2Desc(): string
    {
        return $this->utp2Desc;
    }

    public function setUtp2Desc(string $utp2Desc): static
    {
        $this->utp2Desc = $utp2Desc;
        return $this;
    }

    public function getUtp3Label(): string
    {
        return $this->utp3Label;
    }

    public function setUtp3Label(string $utp3Label): static
    {
        $this->utp3Label = $utp3Label;
        return $this;
    }

    public function getUtp3Desc(): string
    {
        return $this->utp3Desc;
    }

    public function setUtp3Desc(string $utp3Desc): static
    {
        $this->utp3Desc = $utp3Desc;
        return $this;
    }

    public function getBeforeAlt(): string
    {
        return $this->beforeAlt;
    }

    public function setBeforeAlt(string $beforeAlt): static
    {
        $this->beforeAlt = $beforeAlt;
        return $this;
    }

    public function getAfterAlt(): string
    {
        return $this->afterAlt;
    }

    public function setAfterAlt(string $afterAlt): static
    {
        $this->afterAlt = $afterAlt;
        return $this;
    }

    public function getImgBeforeFile(): ?File
    {
        return $this->imgBeforeFile;
    }

    public function setImgBeforeFile(?File $file): static
    {
        $this->imgBeforeFile = $file;
        if ($file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImgBeforeName(): ?string
    {
        return $this->imgBeforeName;
    }

    public function setImgBeforeName(?string $name): static
    {
        $this->imgBeforeName = $name;
        return $this;
    }

    public function getImgAfterFile(): ?File
    {
        return $this->imgAfterFile;
    }

    public function setImgAfterFile(?File $file): static
    {
        $this->imgAfterFile = $file;
        if ($file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImgAfterName(): ?string
    {
        return $this->imgAfterName;
    }

    public function setImgAfterName(?string $name): static
    {
        $this->imgAfterName = $name;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $dt): static
    {
        $this->updatedAt = $dt;
        return $this;
    }

    public function __toString(): string
    {
        return $this->titleTop !== '' ? $this->titleTop : 'Home hero';
    }
}

