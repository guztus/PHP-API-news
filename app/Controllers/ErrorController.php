<?php declare(strict_types=1);

namespace App\Controllers;

use App\Template;

class ErrorController
{
    public function index(
        int    $errorCode,
        string $errorMessage,
        string $buttonName = 'Get me to the man page',
        string $buttonLink = '/'
    ): Template
    {
        return new Template("errors/error.view.twig", [
                'errorCode' => $errorCode,
                'errorMessage' => $errorMessage,
                'buttonName' => $buttonName,
                'buttonLink' => $buttonLink]
        );
    }
}