<?php

namespace App\Controllers;

use App\Template;
use Twig\Environment;

class ErrorController
{
    public function index(Environment $twig, string $errorType)
    {
        return new Template($twig, "errors/{$errorType}.view.twig");
    }
}