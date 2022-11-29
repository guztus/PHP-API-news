<?php

use App\Router;
use App\TwigLoader;

require_once 'vendor/autoload.php';

(Dotenv\Dotenv::createImmutable(__DIR__))->load();

Router::route(new TwigLoader());