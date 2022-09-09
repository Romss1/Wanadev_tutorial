<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VideoGameEntity
{
    #[ORM\Column]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', unique: true, nullable: false)]
    private string $title;

    #[ORM\Column(type: 'date_immutable', nullable: false)]
    private DateTimeImmutable $releaseDate;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $websiteUrl;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $note;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $completed;

    public function __construct(string $title, DateTimeImmutable $releaseDate, string $websiteUrl, int $note, bool $completed)
    {
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->websiteUrl = $websiteUrl;
        $this->note = $note;
        $this->completed = $completed;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getReleaseDate(): DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(DateTimeImmutable $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getWebsiteUrl(): string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(string $websiteUrl): void
    {
        $this->websiteUrl = $websiteUrl;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function setNote(int $note): void
    {
        $this->note = $note;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }
}
