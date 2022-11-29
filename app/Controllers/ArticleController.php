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