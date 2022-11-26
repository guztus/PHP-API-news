<?php

namespace jcobhams\NewsApi;

use Countable;
use jcobhams\NewsApi\Models\Article;

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