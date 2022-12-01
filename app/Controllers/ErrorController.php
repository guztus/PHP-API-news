<?php

namespace App\Controllers;

use App\Template;
use Twig\Environment;

class ErrorController
{
    public function index(
        Environment $twig,
        string      $errorCode,
        string      $errorMessage,
        string      $buttonName = 'Get me to the man page',
        string      $buttonLink = '/'
    ): Template
    {
        return new Template($twig, "errors/error.view.twig", [
                'errorCode' => $errorCode,
                'errorMessage' => $errorMessage,
                'buttonName' => $buttonName,
                'buttonLink' => $buttonLink]
        );
    }
}