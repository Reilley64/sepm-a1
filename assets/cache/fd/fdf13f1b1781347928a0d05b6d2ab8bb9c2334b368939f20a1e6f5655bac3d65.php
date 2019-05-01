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

/* templates/base.html.twig */
class __TwigTemplate_054d8ea96a1ad3c2b02003cb4d4d14642d57484bd789db9d56c2b490491ec59a extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<body>
    ";
        // line 4
        $this->displayBlock('content', $context, $blocks);
        // line 5
        echo "</body>
</html>";
    }

    // line 4
    public function block_content($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "templates/base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  48 => 4,  43 => 5,  41 => 4,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "templates/base.html.twig", "C:\\Users\\Reilley\\Documents\\GitHub\\sepm-a1\\assets\\views\\templates\\base.html.twig");
    }
}
