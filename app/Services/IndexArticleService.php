<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Collections\ArticleCollection;
use jcobhams\NewsApi\NewsApi;

class IndexArticleService
{
    public static function execute(string $searchQuery, string $type): ArticleCollection
    {
        $newsApi = new NewsApi($_ENV['APIKEY']);

        if ($type == 'search') {
            $articlesFromApi = $newsApi->getEverything($searchQuery, null, null, null, null, null, 'en', 'publishedAt');
        } else if ($type == 'category') {
            $articlesFromApi = $newsApi->getTopHeadlines(null, null, null, $searchQuery);
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