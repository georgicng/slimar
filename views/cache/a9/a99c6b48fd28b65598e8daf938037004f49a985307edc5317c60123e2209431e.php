<?php

/* cat.twig */
class __TwigTemplate_67164e81f07da9ff5994c57066c3750cafc62e9316e0ba0c00c00b8ec104fe16 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 9
        $this->parent = $this->loadTemplate("./layout/layout.twig", "cat.twig", 9);
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
        echo "\t";
        $context["check"] = $this;
        echo "\t
\t<div class=\"content\">
\t";
        // line 14
        if ((twig_length_filter($this->env, ($context["games"] ?? null)) <= 0)) {
            // line 15
            echo "\t\t<div class=\"alert alert-warning\" role=\"alert\">There are no existing games in this category</div>
\t";
        } else {
            // line 16
            echo "\t\t\t\t
\t\t<div class=\"mb-3\">
\t\t\t<a href=\"cat.php?c=";
            // line 18
            echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["category"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["title"] ?? null) : null), "html", null, true);
            echo "\" class=\"btn ";
            echo $context["check"]->macro_bold("latest", ($context["primary"] ?? null));
            echo "\">Latest</a>
\t\t\t<a href=\"cat.php?c=";
            // line 19
            echo twig_escape_filter($this->env, (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["category"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["title"] ?? null) : null), "html", null, true);
            echo "&s=rated\" class=\"btn ";
            echo $context["check"]->macro_bold("rated", ($context["primary"] ?? null));
            echo "\">Top Rated</a>
\t\t\t<a href=\"cat.php?c=";
            // line 20
            echo twig_escape_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = ($context["category"] ?? null)) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["title"] ?? null) : null), "html", null, true);
            echo "&s=popular\" class=\"btn ";
            echo $context["check"]->macro_bold("popular", ($context["primary"] ?? null));
            echo "\">Popular</a>
\t\t\t<a href=\"cat.php?c=";
            // line 21
            echo twig_escape_filter($this->env, (($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 = ($context["category"] ?? null)) && is_array($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9) || $__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 instanceof ArrayAccess ? ($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9["title"] ?? null) : null), "html", null, true);
            echo "&s=random\" class=\"btn ";
            echo $context["check"]->macro_bold("random", ($context["primary"] ?? null));
            echo "\">Random</a>
\t\t</div>
\t\t<div class=\"row\">
\t\t\t";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["games"] ?? null));
            foreach ($context['_seq'] as $context["ind"] => $context["g"]) {
                // line 25
                echo "\t\t\t\t<div class=\"col-sm-6 col-lg-4\">
\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t<img class=\"card-img-top\" src=\"";
                // line 27
                echo twig_escape_filter($this->env, (((($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 = $context["g"]) && is_array($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217) || $__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 instanceof ArrayAccess ? ($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217["image"] ?? null) : null)) ? ((($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 = $context["g"]) && is_array($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105) || $__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 instanceof ArrayAccess ? ($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105["image"] ?? null) : null)) : ("//placehold.it/400x300")), "html", null, true);
                echo "\" alt=\"Card image cap\">
\t\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t\t<h4 class=\"card-title\">";
                // line 29
                echo twig_escape_filter($this->env, (($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 = $context["g"]) && is_array($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779) || $__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 instanceof ArrayAccess ? ($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779["title"] ?? null) : null), "html", null, true);
                echo "</h4>
\t\t\t\t\t\t\t<a href=\"play.php?g=";
                // line 30
                echo twig_escape_filter($this->env, (($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 = $context["g"]) && is_array($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1) || $__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 instanceof ArrayAccess ? ($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1["url"] ?? null) : null), "html", null, true);
                echo "\" class=\"btn btn-primary\">Play</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>\t\t\t\t\t\t
\t\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['ind'], $context['g'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "\t\t</div>
\t";
        }
        // line 37
        echo "\t</div>
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
        return "cat.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 5,  130 => 3,  127 => 2,  114 => 1,  109 => 37,  105 => 35,  94 => 30,  90 => 29,  85 => 27,  81 => 25,  77 => 24,  69 => 21,  63 => 20,  57 => 19,  51 => 18,  47 => 16,  43 => 15,  41 => 14,  35 => 12,  32 => 11,  15 => 9,);
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
\t{% import _self as check %}\t
\t<div class=\"content\">
\t{% if ( games | length <= 0) %}
\t\t<div class=\"alert alert-warning\" role=\"alert\">There are no existing games in this category</div>
\t{% else %}\t\t\t\t
\t\t<div class=\"mb-3\">
\t\t\t<a href=\"cat.php?c={{ category['title'] }}\" class=\"btn {{ check.bold('latest', primary) }}\">Latest</a>
\t\t\t<a href=\"cat.php?c={{ category['title'] }}&s=rated\" class=\"btn {{ check.bold('rated', primary) }}\">Top Rated</a>
\t\t\t<a href=\"cat.php?c={{ category['title'] }}&s=popular\" class=\"btn {{ check.bold('popular', primary) }}\">Popular</a>
\t\t\t<a href=\"cat.php?c={{ category['title'] }}&s=random\" class=\"btn {{ check.bold('random', primary) }}\">Random</a>
\t\t</div>
\t\t<div class=\"row\">
\t\t\t{% for ind, g in games %}
\t\t\t\t<div class=\"col-sm-6 col-lg-4\">
\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t<img class=\"card-img-top\" src=\"{{g['image']?: '//placehold.it/400x300'}}\" alt=\"Card image cap\">
\t\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t\t<h4 class=\"card-title\">{{g['title']}}</h4>
\t\t\t\t\t\t\t<a href=\"play.php?g={{g['url']}}\" class=\"btn btn-primary\">Play</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>\t\t\t\t\t\t
\t\t\t\t</div>
\t\t\t{% endfor %}
\t\t</div>
\t{% endif %}
\t</div>
{% endblock %}", "cat.twig", "C:\\wamp64\\www\\slimar\\views\\cat.twig");
    }
}
