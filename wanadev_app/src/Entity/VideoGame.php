<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

class VideoGame
{
    private string $titre;

    private DateTimeImmutable $releaseDate;

    private string $websiteUrl;

    private int $note;

    private bool $completed;

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
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
