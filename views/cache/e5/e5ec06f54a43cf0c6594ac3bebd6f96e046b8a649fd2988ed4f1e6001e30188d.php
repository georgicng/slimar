<?php

/* search.twig */
class __TwigTemplate_8fd587bafc9ab840ff262445730b111c4c758dfb837a64b1a78e4a1b346392cf extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout.twig", "search.twig", 1);
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

    // line 2
    public function block_content($context, array $blocks = array())
    {
        echo " 
<div class=\"row\">
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["games"] ?? null));
        foreach ($context['_seq'] as $context["ind"] => $context["g"]) {
            // line 5
            echo "        <div class=\"col-sm-6 col-lg-4\">
            <div class=\"card\">
                <img class=\"card-img-top\" src=\"";
            // line 7
            echo twig_escape_filter($this->env, (((($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = $context["g"]) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["image"] ?? null) : null)) ? ((($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = $context["g"]) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["image"] ?? null) : null)) : ("//placehold.it/400x300")), "html", null, true);
            echo "\" alt=\"Card image cap\">
                <div class=\"card-body\">
                    <h4 class=\"card-title\">";
            // line 9
            echo twig_escape_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = $context["g"]) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["title"] ?? null) : null), "html", null, true);
            echo "</h4>
                    <a href=\"play.php?g=";
            // line 10
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
        // line 14
        echo " ";
        if ((twig_length_filter($this->env, ($context["games"] ?? null)) == 0)) {
            // line 15
            echo "        <div class=\"alert alert-warning\" role=\"alert\">No games were found. Please try a different search</div>
    ";
        }
        // line 17
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "search.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 17,  69 => 15,  66 => 14,  55 => 10,  51 => 9,  46 => 7,  42 => 5,  38 => 4,  32 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout.twig\" %} 
{% block content %} 
<div class=\"row\">
    {% for ind,g in games %}
        <div class=\"col-sm-6 col-lg-4\">
            <div class=\"card\">
                <img class=\"card-img-top\" src=\"{{g['image']?: '//placehold.it/400x300'}}\" alt=\"Card image cap\">
                <div class=\"card-body\">
                    <h4 class=\"card-title\">{{g['title']}}</h4>
                    <a href=\"play.php?g={{g['url']}}\" class=\"btn btn-primary\">Play</a>
                </div>
            </div>\t\t\t\t\t\t
        </div>
    {% endfor %} {% if (games | length == 0) %}
        <div class=\"alert alert-warning\" role=\"alert\">No games were found. Please try a different search</div>
    {% endif %}
</div>
{% endblock %}", "search.twig", "C:\\wamp64\\www\\slimar\\views\\search.twig");
    }
}
