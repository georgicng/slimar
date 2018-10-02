<?php

/* page.twig */
class __TwigTemplate_83dccc4c57f5ab33206b071bd2b6fe8984e9bfc3e32242a3fe7ed58dbe01eabb extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout.twig", "page.twig", 1);
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

    public function block_content($context, array $blocks = array())
    {
        // line 2
        echo "<div class=\"content\">
    ";
        // line 3
        if (($context["page"] ?? null)) {
            // line 4
            echo "        ";
            echo ($context["page"] ?? null);
            echo "
    ";
        } else {
            // line 6
            echo "        <div class=\"alert alert-warning\"> Page not found </div>
    ";
        }
        // line 8
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 8,  45 => 6,  39 => 4,  37 => 3,  34 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout.twig\" %} {% block content %}
<div class=\"content\">
    {% if (page) %}
        {{ page | raw }}
    {% else %}
        <div class=\"alert alert-warning\"> Page not found </div>
    {% endif %}
</div>
{% endblock %}", "page.twig", "C:\\wamp64\\www\\slimar\\views\\page.twig");
    }
}
