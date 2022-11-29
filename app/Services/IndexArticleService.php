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

    public function execute(string $searchQuery, string $type): ArticleCollection
    {
        if ($type == 'search') {
            $articlesFromApi = $this->apiKey->getEverything($searchQuery, null, null, null, null, null, 'en', 'publishedAt');
        } else if ($type == 'category') {
            $articlesFromApi = $this->apiKey->getTopHeadlines(null, null, null, $searchQuery);
        }

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