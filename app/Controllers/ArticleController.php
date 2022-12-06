<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\IndexArticleService;
use App\Template;

class ArticleController
{
    public function index(): Template
    {
        $articleFetch = new IndexArticleService();
        if (isset($_GET['search'])) {
            $articles = $articleFetch->searchEverything($_GET['search'], $_GET['sortBy']);
        } else if (isset($_GET['category'])) {
            $articles = $articleFetch->searchByCategory($_GET['category']);
        } else {
            return new Template('main/main.view.twig');
        }

        return new Template('articles/articles.view.twig', ['GET' => $_GET, 'articles' => $articles, 'articleCount' => $articles->count()]);
    }
}