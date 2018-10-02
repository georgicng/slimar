<?php

/* payment.twig */
class __TwigTemplate_345f529505d99481ba8ec82bc97f4cded7e3229052f0fce0ba7aa3c16206ef78 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout_cover.twig", "payment.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "./layout/layout_cover.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        echo " 
    <div class=\"inner cover\">
        <h1 class=\"cover-heading\">";
        // line 5
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</h1>
        <p class=\"lead\">";
        // line 6
        echo ($context["message"] ?? null);
        echo "</p>
        <p class=\"lead\">
          ";
        // line 8
        echo ($context["action"] ?? null);
        echo "
        </p>
    </div>
";
    }

    public function getTemplateName()
    {
        return "payment.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 8,  42 => 6,  38 => 5,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout_cover.twig\" %}

{% block content %} 
    <div class=\"inner cover\">
        <h1 class=\"cover-heading\">{{title}}</h1>
        <p class=\"lead\">{{ message | raw }}</p>
        <p class=\"lead\">
          {{ action | raw }}
        </p>
    </div>
{% endblock %}", "payment.twig", "C:\\wamp64\\www\\slimar\\views\\payment.twig");
    }
}
