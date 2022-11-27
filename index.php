<?php

use jcobhams\NewsApi\Router;
use jcobhams\NewsApi\TwigLoader;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Router::route(new TwigLoader());