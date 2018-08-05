<?php

/* partials/left_sidebar.twig */
class __TwigTemplate_b98e15220400be2f4a2c920f0092b3172599162ae1ad7c633744237ce3c8a65e extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<ul class=\"nav navbar-nav\">
    <li ";
        // line 2
        if ((($context["pagename"] ?? null) == "home")) {
            echo " class=\"active\" ";
        }
        echo ">
        <a href=\"index.php\">Home </a>        
    </li>
\t";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["index"] => $context["cat"]) {
            // line 6
            echo "
        <li>
          <a href=\"cat.php?c=";
            // line 8
            echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = $context["cat"]) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["title"] ?? null) : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = $context["cat"]) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["title"] ?? null) : null), "html", null, true);
            echo "</a>
        </li>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['index'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "</ul>";
    }

    public function getTemplateName()
    {
        return "partials/left_sidebar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 11,  42 => 8,  38 => 6,  34 => 5,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<ul class=\"nav navbar-nav\">
    <li {% if (pagename == \"home\") %} class=\"active\" {% endif %}>
        <a href=\"index.php\">Home </a>        
    </li>
\t{% for index, cat in categories %}

        <li>
          <a href=\"cat.php?c={{ cat['title'] }}\">{{ cat['title'] }}</a>
        </li>
\t{% endfor %}
</ul>", "partials/left_sidebar.twig", "C:\\xampp\\htdocs\\slimar\\templates\\partials\\left_sidebar.twig");
    }
}
