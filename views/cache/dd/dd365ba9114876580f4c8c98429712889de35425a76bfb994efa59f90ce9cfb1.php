<?php

/* partials/right_sidebar.twig */
class __TwigTemplate_fea96c8f0523db633058ca619233dba0c85b82602e80397a1cced381fd5626d2 extends Twig_Template
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
        if (((($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["ads_enabled"] ?? null) : null) == 1)) {
            // line 2
            echo "<div class=\"contentcontainer contentbg\">
\t<div class=\"content-container\">
\t    ";
            // line 4
            echo (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["i"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["ad_1"] ?? null) : null);
            echo "
\t</div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "partials/right_sidebar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 4,  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if (i['ads_enabled'] == 1) %}
<div class=\"contentcontainer contentbg\">
\t<div class=\"content-container\">
\t    {{i['ad_1']|raw}}
\t</div>
</div>
{% endif %}", "partials/right_sidebar.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\right_sidebar.twig");
    }
}
