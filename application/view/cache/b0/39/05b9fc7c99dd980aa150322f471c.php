<?php

/* static/header.twig */
class __TwigTemplate_b03905b9fc7c99dd980aa150322f471c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'header' => array($this, 'block_header'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('header', $context, $blocks);
    }

    public function block_header($context, array $blocks = array())
    {
        // line 2
        echo "
<div id=\"header\">
    <h1 id=\"title\">Welcome Hall Mission</h1>
    <div id=\"nav\">
        <div class=\"tiptip\">
            ";
        // line 8
        echo "            ";
        if ((isset($context["is_admin"]) ? $context["is_admin"] : null)) {
            // line 9
            echo "                <img src=\"assets/img/web/admin-logo.jpeg\" alt=\"Admin\" id=\"unicorn\" />
            ";
        }
        // line 11
        echo "
            <a href=\"index.php\" class=\"button\" title=\"Home\">
                <span class=\"icon icon108\"></span><span class=\"label\"></span>
            </a>

            <a href=\"index.php?search\" class=\"button\" title=\"Search\">
                <span class=\"icon icon198\"></span><span class=\"label\">Search</span>
            </a>

            ";
        // line 20
        if ((isset($context["is_logged_in"]) ? $context["is_logged_in"] : null)) {
            // line 21
            echo "                <a href=\"index.php?member\" class=\"button\" title=\"Profile\">
                    <span class=\"icon icon191\"></span><span class=\"label\">
                    ";
            // line 23
            if ((isset($context["username"]) ? $context["username"] : null)) {
                echo " ";
                echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
                echo " ";
            } else {
                echo " Profile ";
            }
            // line 24
            echo "                    </span>
                </a>
                <a href=\"index.php?post\" class=\"button\" title=\"Post Offer\">
                    <span class=\"icon icon130\"></span><span class=\"label\">Post Offer</span>
                </a>

                ";
            // line 30
            if ((isset($context["is_admin"]) ? $context["is_admin"] : null)) {
                // line 31
                echo "                    <a href=\"index.php?admin\" class=\"button\" title=\"Admin Tool\">
                        <span class=\"icon icon185\"></span><span class=\"label\">Admin</span>
                    </a>

                    <a href=\"index.php?garage\" class=\"button\" title=\"Garage\">
                        <span class=\"icon icon2\"></span><span class=\"label\">Garage</span>
                    </a>
                ";
            }
            // line 39
            echo "
                <a href=\"index.php?login&logout=1\" class=\"button\" title=\"Sign Out\">
                    <span class=\"icon icon151\"></span><span class=\"label\">Sign Out</span>
                </a>
            ";
        } else {
            // line 44
            echo "
                <a href=\"index.php?login\" class=\"button\" title=\"Sign In\">
                    <span class=\"icon icon116\"></span><span class=\"label\">Sign In</span>
                </a>
                <a href=\"index.php?registration\" class=\"button\" title=\"Register\">
                    <span class=\"icon icon60\"></span><span class=\"label\">Register</span>
                </a>
            ";
        }
        // line 52
        echo "        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "static/header.twig";
    }

    public function getDebugInfo()
    {
        return array (  100 => 52,  90 => 44,  83 => 39,  73 => 31,  71 => 30,  63 => 24,  55 => 23,  51 => 21,  49 => 20,  38 => 11,  34 => 9,  31 => 8,  24 => 2,  18 => 1,);
    }
}
