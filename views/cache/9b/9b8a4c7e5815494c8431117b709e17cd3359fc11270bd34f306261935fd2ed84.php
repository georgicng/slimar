<?php

/* games.twig */
class __TwigTemplate_94ec4ca573b3450f910484a747494a4e1c1d24db6432fbf107bf543478ba3ab2 extends Twig_Template
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
        echo "<div class=\"content\">
    ";
        // line 14
        if ((twig_length_filter($this->env, ($context["games"] ?? null)) > 0)) {
            // line 15
            echo "        <div class=\"mb-3\">
            <a href=\"games.php\" class=\"btn ";
            // line 16
            echo $context["check"]->macro_bold("latest", ($context["primary"] ?? null));
            echo "\">Latest</a>
            <a href=\"games.php?s=rated\" class=\"btn ";
            // line 17
            echo $context["check"]->macro_bold("rated", ($context["primary"] ?? null));
            echo "\">Top Rated</a>
            <a href=\"games.php?s=popular\" class=\"btn ";
            // line 18
            echo $context["check"]->macro_bold("popular", ($context["primary"] ?? null));
            echo "\">Popular</a>
            <a href=\"games.php?s=random\" class=\"btn ";
            // line 19
            echo $context["check"]->macro_bold("random", ($context["primary"] ?? null));
            echo "\">Random</a>
        </div>
        <div class=\"row\">
        ";
            // line 22
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["games"] ?? null));
            foreach ($context['_seq'] as $context["ind"] => $context["g"]) {
                // line 23
                echo "            <div class=\"col-sm-6 col-lg-4\">
                <div class=\"card\">
                    <img class=\"card-img-top\" src=\"";
                // line 25
                echo twig_escape_filter($this->env, (((($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = $context["g"]) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["image"] ?? null) : null)) ? ((($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = $context["g"]) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["image"] ?? null) : null)) : ("//placehold.it/400x300")), "html", null, true);
                echo "\" alt=\"Card image cap\">
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">";
                // line 27
                echo twig_escape_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = $context["g"]) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["title"] ?? null) : null), "html", null, true);
                echo "</h4>
                        <a href=\"play.php?g=";
                // line 28
                echo twig_escape_filter($this->env, (($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 = $context["g"]) && is_array($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9) || $__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 instanceof ArrayAccess ? ($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9["url"] ?? null) : null), "html", null, true);
                echo "\" class=\"btn btn-primary\">Play</a>
                    </div>
                </div>\t\t\t\t\t\t
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['ind'], $context['g'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "\t\t\t\t\t 
        </div>
    ";
        } else {
            // line 35
            echo "        <div class=\"alert alert-warning\" role=\"alert\">There are no existing games</div>
    ";
        }
        // line 36
        echo "\t
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
        return array (  126 => 5,  122 => 3,  119 => 2,  106 => 1,  100 => 36,  96 => 35,  91 => 32,  80 => 28,  76 => 27,  71 => 25,  67 => 23,  63 => 22,  57 => 19,  53 => 18,  49 => 17,  45 => 16,  42 => 15,  40 => 14,  37 => 13,  35 => 12,  32 => 11,  15 => 9,);
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
<div class=\"content\">
    {% if games|length > 0 %}
        <div class=\"mb-3\">
            <a href=\"games.php\" class=\"btn {{ check.bold('latest', primary) }}\">Latest</a>
            <a href=\"games.php?s=rated\" class=\"btn {{ check.bold('rated', primary) }}\">Top Rated</a>
            <a href=\"games.php?s=popular\" class=\"btn {{ check.bold('popular', primary) }}\">Popular</a>
            <a href=\"games.php?s=random\" class=\"btn {{ check.bold('random', primary) }}\">Random</a>
        </div>
        <div class=\"row\">
        {% for ind, g in games %}
            <div class=\"col-sm-6 col-lg-4\">
                <div class=\"card\">
                    <img class=\"card-img-top\" src=\"{{g['image']?: '//placehold.it/400x300'}}\" alt=\"Card image cap\">
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">{{g['title']}}</h4>
                        <a href=\"play.php?g={{g['url']}}\" class=\"btn btn-primary\">Play</a>
                    </div>
                </div>\t\t\t\t\t\t
            </div>
        {% endfor %}\t\t\t\t\t 
        </div>
    {% else %}
        <div class=\"alert alert-warning\" role=\"alert\">There are no existing games</div>
    {% endif %}\t
</div>
{% endblock %}", "games.twig", "C:\\wamp64\\www\\slimar\\views\\games.twig");
    }
}
