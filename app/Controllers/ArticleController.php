<?php

namespace App\Controllers;

use App\Services\IndexArticleService;
use App\Template;
use Twig\Environment;

class ArticleController
{
    public function index(Environment $twig): Template
    {
        $articleFetch = new IndexArticleService();
        if (isset($_GET['search'])) {
            $articles = $articleFetch->searchEverything($_GET['search'], $_GET['sortBy']);
        } else if (isset($_GET['category'])) {
            $articles = $articleFetch->searchByCategory($_GET['category']);
        } else {
            return new Template($twig, 'main/main.view.twig', []);
        }

        return new Template($twig, 'articles/articles.view.twig', ['GET' => $_GET, 'articles' => $articles, 'articleCount' => $articles->count()]);
    }
}