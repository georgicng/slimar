<?php

/* partials/alert_success.twig */
class __TwigTemplate_f3180ceb2d7832f2cdbe3819a2174049792403ce7fd34d1d9c8fe612b134c996 extends Twig_Template
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
        echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
    <strong>SUCCESS:</strong> ";
        // line 2
        echo ($context["success"] ?? null);
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "partials/alert_success.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
    <strong>SUCCESS:</strong> {{ success | raw }}
</div>", "partials/alert_success.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\alert_success.twig");
    }
}
