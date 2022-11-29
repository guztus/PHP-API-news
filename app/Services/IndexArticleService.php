<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Collections\ArticleCollection;
use jcobhams\NewsApi\NewsApi;

class IndexArticleService
{
    private NewsApi $apiKey;

    public function __construct()
    {
        $this->apiKey = new NewsApi($_ENV['APIKEY']);
    }

    public function searchEverything(string $searchQuery, ?string $sortBy = 'publishedAt'): ArticleCollection
    {
        if ($sortBy == null) {
            $sortBy = 'publishedAt';
        }
        $articlesFromApi = $this->apiKey->getEverything($searchQuery, null, null, null, null, null, 'en', $sortBy);
        return $this->createList($articlesFromApi);
    }

    public function searchByCategory(string $searchQuery): ArticleCollection
    {
        $articlesFromApi = $this->apiKey->getTopHeadlines(null, null, null, $searchQuery);
        return $this->createList($articlesFromApi);
    }

    private function createList($articlesFromApi): ArticleCollection
    {
        $articles = new ArticleCollection();
        foreach ($articlesFromApi->articles as $article) {
            $articles->addArticles(new Article (
                $article->title,
                $article->url,
                $article->description,
                $article->urlToImage,
                $article->publishedAt,
                $article->source->name
            ));
        }
        return $articles;
    }
}