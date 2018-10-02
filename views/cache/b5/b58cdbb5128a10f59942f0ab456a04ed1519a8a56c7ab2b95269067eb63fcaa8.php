<?php

/* partials/left_sidebar.twig */
class __TwigTemplate_b4bb53bf67dac3bad27fde4737991b0cc625357ae98a2f416437bdecb9f59056 extends Twig_Template
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
        echo twig_get_attribute($this->env, $this->source, ($context["header_menu"] ?? null), "html", array(), "method");
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
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{{ header_menu.html() | raw }}", "partials/left_sidebar.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\left_sidebar.twig");
    }
}
