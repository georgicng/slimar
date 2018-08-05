<?php

/* partials/footer.twig */
class __TwigTemplate_2a127425884f3d72a1998de127db135bce37accb0f5b15b3986c4cebbc5f19a4 extends Twig_Template
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
        echo "<div class=\"footer\">
\t<div class=\"container\">
\t\t<div style=\"float:left;\">";
        // line 3
        echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["title"] ?? null) : null), "html", null, true);
        echo " &copy; 2017. All rights reserved</div>
\t\t<div class=\"footer_right\">
\t\t\t<a href=\"contact.php\">Contact</a>
\t\t\t<a href=\"about.php\">About</a>
\t\t\t<a href=\"suggest.php\">Suggest</a>
\t\t\t<a href=\"members.php\">Members</a>
\t\t</div>
\t</div>
</div>
<script type=\"text/javascript\" src=\"files/js/bootstrap.offcanvas.min.js\"></script>
<script type=\"text/javascript\" src=\"files/js/script-loader.js\"></script>";
    }

    public function getTemplateName()
    {
        return "partials/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 3,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"footer\">
\t<div class=\"container\">
\t\t<div style=\"float:left;\">{{i['title']}} &copy; 2017. All rights reserved</div>
\t\t<div class=\"footer_right\">
\t\t\t<a href=\"contact.php\">Contact</a>
\t\t\t<a href=\"about.php\">About</a>
\t\t\t<a href=\"suggest.php\">Suggest</a>
\t\t\t<a href=\"members.php\">Members</a>
\t\t</div>
\t</div>
</div>
<script type=\"text/javascript\" src=\"files/js/bootstrap.offcanvas.min.js\"></script>
<script type=\"text/javascript\" src=\"files/js/script-loader.js\"></script>", "partials/footer.twig", "C:\\xampp\\htdocs\\slimar\\templates\\partials\\footer.twig");
    }
}
