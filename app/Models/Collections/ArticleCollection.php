<?php declare(strict_types=1);

namespace App\Models\Collections;

use Countable;
use App\Models\Article;

class ArticleCollection implements Countable
{
    public array $articles = [];

    public function addArticles(Article ...$articles): void
    {
        $this->articles = array_merge($this->articles, $articles);
    }

    public function count(): int
    {
        return count($this->articles);
    }
}