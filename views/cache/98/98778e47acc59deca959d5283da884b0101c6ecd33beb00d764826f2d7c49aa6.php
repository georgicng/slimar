<?php

/* partials/breadcrumbs.twig */
class __TwigTemplate_207f123432750d8abee6a4f2d3be57ee17e630d13539aae1ae57f59212b392e3 extends Twig_Template
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
        echo "
<section>
    <div class=\"container\">
        <nav aria-label=\"breadcrumb\">
            <ol class=\"breadcrumb\">
                <li class=\"breadcrumb-item\"><a href=\"#\">Home</a></li>
                <li class=\"breadcrumb-item\"><a href=\"#\">Library</a></li>
                <li class=\"breadcrumb-item active\" aria-current=\"page\">Data</li>
            </ol>
        </nav>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "partials/breadcrumbs.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("
<section>
    <div class=\"container\">
        <nav aria-label=\"breadcrumb\">
            <ol class=\"breadcrumb\">
                <li class=\"breadcrumb-item\"><a href=\"#\">Home</a></li>
                <li class=\"breadcrumb-item\"><a href=\"#\">Library</a></li>
                <li class=\"breadcrumb-item active\" aria-current=\"page\">Data</li>
            </ol>
        </nav>
    </div>
</section>", "partials/breadcrumbs.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\breadcrumbs.twig");
    }
}
