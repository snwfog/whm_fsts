<?php

/* static/footer.twig */
class __TwigTemplate_862472dd69531ccde117bc33b6696272 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('footer', $context, $blocks);
    }

    public function block_footer($context, array $blocks = array())
    {
        // line 2
        echo "<div id=\"footer\">
    <p>Wiz. Trade is an affiliate of GoBAGSys.</p>
    <p>You are viewing this page on ";
        // line 4
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "D, d M Y H:i:s"), "html", null, true);
        echo ".</p>
\t<p class=\"footer\">Copyright 2012</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "static/footer.twig";
    }

    public function getDebugInfo()
    {
        return array (  100 => 52,  90 => 44,  83 => 39,  73 => 31,  71 => 30,  51 => 21,  49 => 20,  38 => 11,  34 => 9,  31 => 8,  30 => 5,  28 => 4,  24 => 2,  76 => 36,  67 => 39,  63 => 24,  61 => 36,  55 => 23,  27 => 7,  25 => 6,  18 => 1,  29 => 11,  26 => 3,);
    }
}
