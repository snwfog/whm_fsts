<?php

/* static/base.twig */
class __TwigTemplate_715a0d3846a88934eb7b085e9bc91d78 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>

\t<title>
\t\t";
        // line 6
        $this->env->loadTemplate("static/title.twig")->display($context);
        // line 7
        echo "\t</title>

    <script type=\"text/javascript\" src=\"assets/js/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/jquery.tiptip.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/g/raphael.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/g/ico.min.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/noty/jquery.noty.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/noty/layouts/bottomRight.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/noty/layouts/center.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/noty/themes/default.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/validate.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/moment.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/script.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/ajax.js\"></script>

    <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/reset.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/button-style.css\" media=\"screen\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/tiptip.css\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/style.css\" />
\t<link rel='icon' type='image/x-icon' href='assets/img/web/favicon.ico'>

\t<link href='http://fonts.googleapis.com/css?family=Rambla|Anaheim' rel='stylesheet' type='text/css'>


</head>
<body>
\t<div id=\"header\">";
        // line 33
        $this->env->loadTemplate("static/header.twig")->display($context);
        echo "</div>
    <div id=\"content\">

\t\t";
        // line 36
        $this->displayBlock('content', $context, $blocks);
        // line 37
        echo "
\t</div>
    <div id=\"footer\">";
        // line 39
        $this->env->loadTemplate("static/footer.twig")->display($context);
        echo "</div>

</body>
</html>
";
    }

    // line 36
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "static/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 36,  67 => 39,  63 => 37,  61 => 36,  55 => 33,  27 => 7,  25 => 6,  18 => 1,  29 => 11,  26 => 3,);
    }
}
