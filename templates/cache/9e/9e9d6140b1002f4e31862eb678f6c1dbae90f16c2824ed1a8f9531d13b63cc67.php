<?php

/* games.twig */
class __TwigTemplate_636c380c37c28050c79e6b8815a0590a70c30e002daf2cffcab0ddcb894d45ce extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 9
        $this->parent = $this->loadTemplate("./layout/layout.twig", "games.twig", 9);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "./layout/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 11
    public function block_content($context, array $blocks = array())
    {
        // line 12
        $context["check"] = $this;
        // line 13
        echo "<div>
   <div style=\"margin-bottom:10px\">
        <a href=\"index.php\" class=\"btn ";
        // line 15
        echo $context["check"]->macro_bold("latest", ($context["primary"] ?? null));
        echo "\">Latest</a>
        <a href=\"index.php?s=rated\" class=\"btn ";
        // line 16
        echo $context["check"]->macro_bold("rated", ($context["primary"] ?? null));
        echo "\">Top Rated</a>
        <a href=\"index.php?s=popular\" class=\"btn ";
        // line 17
        echo $context["check"]->macro_bold("popular", ($context["primary"] ?? null));
        echo "\">Popular</a>
        <a href=\"index.php?s=random\" class=\"btn ";
        // line 18
        echo $context["check"]->macro_bold("random", ($context["primary"] ?? null));
        echo "\">Random</a>
    </div>
    <div class=\"row\">
        ";
        // line 21
        if ((twig_length_filter($this->env, ($context["games"] ?? null)) > 0)) {
            // line 22
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["games"] ?? null));
            foreach ($context['_seq'] as $context["ind"] => $context["g"]) {
                // line 23
                echo "                <a href=\"game.php?g=";
                echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = $context["g"]) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["url"] ?? null) : null), "html", null, true);
                echo "\">
                    <div class=\"col-sm-3 col-lg-3 col-md-4\">\t\t\t\t\t\t
                        <div class='wrapper' >
                            ";
                // line 26
                if (("hello" == "hello")) {
                    // line 27
                    echo "                            <span style=\"background:#d72633;padding:5px 10px;border-radius:3px;color:white;position:absolute;margin:10px 10px;\">NEW</span>
                            ";
                }
                // line 29
                echo "                            <img class=\"img-responsive img-responsive2\" src='";
                echo twig_escape_filter($this->env, (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = $context["g"]) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["image"] ?? null) : null), "html", null, true);
                echo "' />
                                                    
                            <div class='description'>
                                <p class='description_content'>";
                // line 32
                echo twig_escape_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = $context["g"]) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["title"] ?? null) : null), "html", null, true);
                echo "</p>\t\t\t\t\t\t\t
                            </div>
                        </div>\t\t\t\t\t\t
                    </div>
                </a>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['ind'], $context['g'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "        ";
        } else {
            // line 39
            echo "                <div class=\"container\">
                    <div class=\"alert alert-warning\" role=\"alert\">There are no existing games</div>
                </div>
        ";
        }
        // line 42
        echo "\t\t\t\t\t\t 
    </div>
\t<a href=\"games.php\" class=\"btn btn-primary\">View ALL games</a>
</div>
";
    }

    // line 1
    public function macro_bold($__name__ = null, $__primary__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "primary" => $__primary__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "    ";
            if ((($context["primary"] ?? null) == ($context["name"] ?? null))) {
                // line 3
                echo "        btn-primary
    ";
            } else {
                // line 5
                echo "        btn-default
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "games.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 5,  131 => 3,  128 => 2,  115 => 1,  107 => 42,  101 => 39,  98 => 38,  86 => 32,  79 => 29,  75 => 27,  73 => 26,  66 => 23,  61 => 22,  59 => 21,  53 => 18,  49 => 17,  45 => 16,  41 => 15,  37 => 13,  35 => 12,  32 => 11,  15 => 9,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% macro bold(name, primary) %}
    {% if (primary == name) %}
        btn-primary
    {% else %}
        btn-default
    {% endif %}
{% endmacro %}

{% extends \"./layout/layout.twig\" %}

{% block content %}
{% import _self as check %}
<div>
   <div style=\"margin-bottom:10px\">
        <a href=\"index.php\" class=\"btn {{ check.bold('latest', primary) }}\">Latest</a>
        <a href=\"index.php?s=rated\" class=\"btn {{ check.bold('rated', primary) }}\">Top Rated</a>
        <a href=\"index.php?s=popular\" class=\"btn {{ check.bold('popular', primary) }}\">Popular</a>
        <a href=\"index.php?s=random\" class=\"btn {{ check.bold('random', primary) }}\">Random</a>
    </div>
    <div class=\"row\">
        {% if games|length > 0 %}
            {% for ind, g in games %}
                <a href=\"game.php?g={{g['url']}}\">
                    <div class=\"col-sm-3 col-lg-3 col-md-4\">\t\t\t\t\t\t
                        <div class='wrapper' >
                            {% if (\"hello\" == \"hello\") %}
                            <span style=\"background:#d72633;padding:5px 10px;border-radius:3px;color:white;position:absolute;margin:10px 10px;\">NEW</span>
                            {% endif %}
                            <img class=\"img-responsive img-responsive2\" src='{{g['image']}}' />
                                                    
                            <div class='description'>
                                <p class='description_content'>{{g['title']}}</p>\t\t\t\t\t\t\t
                            </div>
                        </div>\t\t\t\t\t\t
                    </div>
                </a>
            {% endfor %}
        {% else %}
                <div class=\"container\">
                    <div class=\"alert alert-warning\" role=\"alert\">There are no existing games</div>
                </div>
        {% endif %}\t\t\t\t\t\t 
    </div>
\t<a href=\"games.php\" class=\"btn btn-primary\">View ALL games</a>
</div>
{% endblock %}", "games.twig", "C:\\xampp\\htdocs\\slimar\\templates\\games.twig");
    }
}
