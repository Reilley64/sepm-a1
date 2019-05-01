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

/* ./templates/base.html.twig */
class __TwigTemplate_e1075096be7ca817fa450a71297e98270cc31e1707c8a77a603020dc9b012ed7 extends \Twig\Template
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
        $this->loadTemplate("../shared/header.html.twig", "./templates/base.html.twig", 4)->display($context);
        // line 5
        echo "    ";
        $this->displayBlock('content', $context, $blocks);
        // line 6
        echo "    
</body>
</html>";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "./templates/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 5,  46 => 6,  43 => 5,  41 => 4,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "./templates/base.html.twig", "C:\\Users\\Reilley\\Documents\\GitHub\\sepm-a1\\views\\templates\\base.html.twig");
    }
}
