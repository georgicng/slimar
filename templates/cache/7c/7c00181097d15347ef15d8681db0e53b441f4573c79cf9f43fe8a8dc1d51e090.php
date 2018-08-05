<?php

/* partials/page_header.twig */
class __TwigTemplate_734cd08bf56c46394f816cbc5b67900035ef538b7834ef018b9f477654b3206e extends Twig_Template
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
        echo "<form method=\"post\" action=\"search.php?go\" class=\"navbar-form navbar-left hidden-xs\">
        <div class=\"form-group\">
\t\t\t<input type=\"text\" name=\"search-text\" class=\"form-control\" autocomplete=\"off\" spellcheck=\"false\" placeholder=\"Search game....\">

        </div>
        <button type=\"button\" name=\"search-button\" class=\"form-submit btn btn-search-nav\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i></button>
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
        return new Twig_Source("<form method=\"post\" action=\"search.php?go\" class=\"navbar-form navbar-left hidden-xs\">
        <div class=\"form-group\">
\t\t\t<input type=\"text\" name=\"search-text\" class=\"form-control\" autocomplete=\"off\" spellcheck=\"false\" placeholder=\"Search game....\">

        </div>
        <button type=\"button\" name=\"search-button\" class=\"form-submit btn btn-search-nav\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i></button>
      </form>
", "partials/page_header.twig", "C:\\xampp\\htdocs\\slimar\\templates\\partials\\page_header.twig");
    }
}
