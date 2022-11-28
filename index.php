<?php

use App\Router;
use App\TwigLoader;

require_once 'vendor/autoload.php';
//echo "<pre>";
//var_dump(new \App\Models\Article('title', null, null, null, null, null));
//die;
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

Router::route(new TwigLoader());