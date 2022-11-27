<?php

namespace jcobhams\NewsApi;

use Twig\Environment;

class Template
{
    public function __construct(Environment $twig, string $path, ?array $variables = [])
    {
        echo $twig->render($path, $variables);
    }
}