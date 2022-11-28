<?php

namespace App\Models\Collections;

use Countable;
use App\Models\Article;

class ArticleCollection implements Countable
{
    public array $articles = [];

    public function addArticles(Article ...$articles)
    {
        $this->articles = array_merge($this->articles, $articles);
    }

    public function count(): int
    {
        return count($this->articles);
    }
}