<?php

/* partials/page_header.twig */
class __TwigTemplate_bb95d8e75b78cdc807a05ff1a7a1ab79343fa14a6a345e7ab6862e5aad83984a extends Twig_Template
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
        echo "<!--form method=\"post\" action=\"search.php?go\" class=\"navbar-form navbar-left hidden-xs\">
    <div class=\"form-group\">
        <input type=\"text\" name=\"search-text\" class=\"form-control\" autocomplete=\"off\" spellcheck=\"false\" placeholder=\"Search game....\">
    </div>
    <button type=\"button\" name=\"search-button\" class=\"form-submit btn btn-search-nav\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i></button>
</form-->
<form method=\"post\" action=\"search.php\" class=\"form-inline mr-auto pull-right\">
    <div class=\"form-group has-white\">
        <input type=\"text\" name=\"search-text\" autocomplete=\"off\" spellcheck=\"false\" class=\"form-control\" placeholder=\"Search game....\">
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "partials/page_header.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!--form method=\"post\" action=\"search.php?go\" class=\"navbar-form navbar-left hidden-xs\">
    <div class=\"form-group\">
        <input type=\"text\" name=\"search-text\" class=\"form-control\" autocomplete=\"off\" spellcheck=\"false\" placeholder=\"Search game....\">
    </div>
    <button type=\"button\" name=\"search-button\" class=\"form-submit btn btn-search-nav\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i></button>
</form-->
<form method=\"post\" action=\"search.php\" class=\"form-inline mr-auto pull-right\">
    <div class=\"form-group has-white\">
        <input type=\"text\" name=\"search-text\" autocomplete=\"off\" spellcheck=\"false\" class=\"form-control\" placeholder=\"Search game....\">
    </div>
</form>
", "partials/page_header.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\page_header.twig");
    }
}
