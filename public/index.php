<?php

use App\Router;
use App\TwigLoader;

require_once '../vendor/autoload.php';

session_start();
(Dotenv\Dotenv::createImmutable('../'))->load();

Router::route(new TwigLoader());