<?php

namespace jcobhams\NewsApi\Controllers;

use jcobhams\NewsApi\ArticleCollection;
use jcobhams\NewsApi\Models\Article;
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\Template;
use Twig\Environment;

class ArticleController
{
    public function index(Environment $twig): Template
    {
        // Search -     , MAYBE can add sorting but that will send many requests
        if (isset($_GET['search'])) {
            $newsApi = new NewsApi($_ENV['APIKEY']);

            $q = $_GET['search'];
            $articlesFromApi = $newsApi->getEverything($q);
        } else if (isset($_GET['category'])) {
            $newsApi = new NewsApi($_ENV['APIKEY']);

            $category = $_GET['category'];
            $articlesFromApi = $newsApi->getTopHeadlines(null, null, null, $category);
        } else {
            return new Template($twig, 'main.view.twig', []);
        }

        $articles = new ArticleCollection();
        foreach ($articlesFromApi->articles as $article) {
            $articles->addArticles(new Article (
                $article->title,
                $article->url,
                $article->description,
                $article->urlToImage
            ));
        }

        return new Template($twig, 'articles.view.twig', ['articles' => $articles, 'articleCount' => $articles->count()]);
//        return $twig->render('index.view.twig', ['articles' => $articles]);
    }
}

// Dummy data
//class ArticleController
//{
//    public function index(Environment $twig): Template
//    {
//        // Articles
////        echo "<pre>";
////        var_dump($_SERVER['REQUEST_URI']);die;
////        var_dump($newsApi->getSources());die;
////        $q = $_GET['search'];
////        $articlesFromApi = $newsApi->getEverything(null, $q);
//        $dummyArticles = [
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'url' => "https://markets.businessinsider.com/news/stocks/alibaba-china-us-stocks-president-xi-jinping-baidu-term-growth-2022-10",
//                'description' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba leaps 10% as US-listed Chinese stocks rally on further speculation Beijing is set to reopen its economy after strict lockdown measures",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://i.insider.com/629dcb533efa8c0019aadffa?width=1200&format=jpeg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'url' => "https://markets.businessinsider.com/news/stocks/alibaba-china-us-stocks-president-xi-jinping-baidu-term-growth-2022-10",
//                'description' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba leaps 10% as US-listed Chinese stocks rally on further speculation Beijing is set to reopen its economy after strict lockdown measures",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://i.insider.com/629dcb533efa8c0019aadffa?width=1200&format=jpeg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'url' => "https://markets.businessinsider.com/news/stocks/alibaba-china-us-stocks-president-xi-jinping-baidu-term-growth-2022-10",
//                'description' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba leaps 10% as US-listed Chinese stocks rally on further speculation Beijing is set to reopen its economy after strict lockdown measures",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://i.insider.com/629dcb533efa8c0019aadffa?width=1200&format=jpeg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'url' => "https://markets.businessinsider.com/news/stocks/alibaba-china-us-stocks-president-xi-jinping-baidu-term-growth-2022-10",
//                'description' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba leaps 10% as US-listed Chinese stocks rally on further speculation Beijing is set to reopen its economy after strict lockdown measures",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://i.insider.com/629dcb533efa8c0019aadffa?width=1200&format=jpeg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'url' => "https://markets.businessinsider.com/news/stocks/alibaba-china-us-stocks-president-xi-jinping-baidu-term-growth-2022-10",
//                'description' => " Alibaba sinks to lowest in 6 years and Nio plummets as US-listed Chinese shares sell off on growth worries after President Xi locks in 3rd term",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//            [
//                'title' => " Alibaba leaps 10% as US-listed Chinese stocks rally on further speculation Beijing is set to reopen its economy after strict lockdown measures",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://i.insider.com/629dcb533efa8c0019aadffa?width=1200&format=jpeg"
//            ],
//            [
//                'title' => "China's Nio suspends production due to COVID measures - Reuters",
//                'url' => "https://www.reuters.com/business/autos-transportation/chinas-nio-suspends-production-due-covid-measures-2022-11-02/",
//                'description' => "China's Nio suspends production due to COVID measures - Reuters",
//                'urlToImage' => "https://www.reuters.com/resizer/fWtCZa3afP8qC-FkPZo9In0Ij04=/1200x628/smart/filters:quality(80)/cloudfront-us-east-2.images.arcpublishing.com/reuters/HRIY2RSPF5PBPBQGRDYGKZHRUY.jpg"
//            ],
//        ];
//
//        $articles = new ArticleCollection();
//
//        foreach ($dummyArticles as $article) {
////            var_dump($article['url']); die;
//            $articles->addArticles(new Article (
//                $article['title'],
//                $article['url'],
//                $article['description'],
//                $article['urlToImage']
//            ));
//        }
//
//        return new Template($twig, 'index.view.twig', ['articles' => $articles, 'articleCount' => $articles->count()]);
////        return $twig->render('index.view.twig', ['articles' => $articles, 'articleCount' => $articles->count()]);
//    }
//}