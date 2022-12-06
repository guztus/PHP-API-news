<?php declare(strict_types=1);

namespace App\Controllers;

use App\Template;

class MainController
{
    public function index(): Template
    {
        return new Template('main/main.view.twig');
    }
}
