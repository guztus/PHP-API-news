<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* index.view.twig */
class __TwigTemplate_9956ad9aeb190904a165aa1f80705a11240b45feb09327b411273f52f190e87c extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Index</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\"
          integrity=\"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65\" crossorigin=\"anonymous\">
</head>
<body>

<div class=\"container-fluid my-2 text-center\">
    <form method=\"get\">
        <label for=\"news-search\">Search news</label>
        <input style=\"border-radius: 5px\" type=\"text\" id=\"news-search\" name=\"search\" required>
        <button type=\"submit\" class=\"btn btn-light\">Search</button>
    </form>
</div>

";
        // line 22
        if (twig_test_empty(($context["articles"] ?? null))) {
            // line 23
            echo "    <a>Nothing was found!</a>
";
        } else {
            // line 25
            echo "    ";
            $context["displayedArticleCount"] = 45;
            // line 26
            echo "
    <a style=\"display: flex; justify-content: right; padding-right: 5px; font-size: 10px\">(*Showing a maximum of ";
            // line 27
            echo twig_escape_filter($this->env, ($context["displayedArticleCount"] ?? null), "html", null, true);
            echo " articles)</a>
    <div class=\"container-fluid\" style=\"width: 95%\">
        <div class=\"row\">
            ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["articles"] ?? null), "articles", [], "any", false, false, false, 30), 1, ($context["displayedArticleCount"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
                // line 31
                echo "                <div class=\"col bg-light p-3 m-1\" style=\"display:flex; border-radius: 15px\">
                    <div>
                        <a href=\"";
                // line 33
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "url", [], "any", false, false, false, 33), "html", null, true);
                echo "\" target=\"_blank\" style=\"text-decoration: none; color: chocolate\"
                        > ";
                // line 34
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "description", [], "any", false, false, false, 34), "html", null, true);
                echo "</a>
                    </div>
                    <div style=\"margin-left: 5px\">
                        <img src=\"";
                // line 37
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "picture", [], "any", false, false, false, 37), "html", null, true);
                echo "\"
                             style=\"width: 180px; border-radius: 15px\"
                             alt=\"article-image\">
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "        </div>
    </div>
";
        }
        // line 46
        echo "</body>
</html>";
    }

    public function getTemplateName()
    {
        return "index.view.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 46,  108 => 43,  96 => 37,  90 => 34,  86 => 33,  82 => 31,  78 => 30,  72 => 27,  69 => 26,  66 => 25,  62 => 23,  60 => 22,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "index.view.twig", "/home/guztus/Desktop/Projects/Nodarbibas/01_homework/__newsapi-php-master/views/index.view.twig");
    }
}
