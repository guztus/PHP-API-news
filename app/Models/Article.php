<?php declare(strict_types=1);

namespace App\Models;

class Article
{
    private ?string $title;
    private ?string $url;
    private ?string $description;
    private ?string $picture;
    private ?string $publishedAt;
    private ?string $source;

    public function __construct(
        ?string $title,
        ?string $url,
        ?string $description,
        ?string $picture,
        ?string $publishedAt,
        ?string $source)
    {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->picture = $picture;
        $this->publishedAt = $publishedAt;
        $this->source = $source;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        if ($this->description) {
            return strip_tags($this->description);
        }
        return $this->description;
    }

    public function getPicture(): string
    {
        if ($this->picture == null) {
            return 'images/default-image.jpg';
        }
        return $this->picture;
    }

    public function getPublishedAt(): ?string
    {
        return $this->publishedAt;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }
}