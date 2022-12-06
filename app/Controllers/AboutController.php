<?php declare(strict_types=1);

namespace App\Controllers;

use App\Template;

class AboutController
{
    public function index(): Template
    {
        return new Template('about/about.view.twig');
    }
}