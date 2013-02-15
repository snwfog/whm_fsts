<?php

/* static/title.twig */
class __TwigTemplate_22f876dfb33e649a517cd3a218ed2131 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('title', $context, $blocks);
    }

    public function block_title($context, array $blocks = array())
    {
        // line 2
        echo "    ";
        // line 3
        echo "    ";
        // line 4
        echo "    ";
        // line 5
        echo "    ";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, (isset($context["specifier"]) ? $context["specifier"] : null), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "static/title.twig";
    }

    public function getDebugInfo()
    {
        return array (  30 => 5,  28 => 4,  24 => 2,  18 => 1,  29 => 11,  26 => 3,);
    }
}
