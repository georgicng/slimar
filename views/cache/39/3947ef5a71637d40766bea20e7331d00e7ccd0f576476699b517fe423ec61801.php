<?php

/* ./layout/layout_full.twig */
class __TwigTemplate_46abae2062c64d5d89fbec19fda9d97bdcf7bbc88351bbb888e5b416f0b83b09 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\"/>
        <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"assets/images/apple-icon.png\">
        <link rel=\"icon\" type=\"image/png\" href=\"assets/images/favicon.png\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"/>
        <title>";
        // line 8
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "</title>
        <base href=\"";
        // line 9
        echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["url"] ?? null) : null), "html", null, true);
        echo "/\">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
        <!-- Fonts and icons -->
        <link href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700,200\" rel=\"stylesheet\"/>
        <link href=\"https://use.fontawesome.com/releases/v5.0.6/css/all.css\" rel=\"stylesheet\">
        <!-- CSS Files -->
        <link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"/>
        <link rel=\"stylesheet\" href=\"//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css\">
        <link href=\"assets/css/now-ui-kit.css?v=1.2.0\" rel=\"stylesheet\"/>
    </head>
    <body class=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo " sidebar-collapse menu-on-left\" id=\"page\">
        ";
        // line 20
        echo twig_include($this->env, $context, "partials/top_bar.twig");
        echo "
        <div class=\"wrapper\">
            <div class=\"page-header clear-filter\">
                <div class=\"content\">
                    <div class=\"container\">
                        ";
        // line 25
        if (($context["error"] ?? null)) {
            // line 26
            echo "                            ";
            echo twig_include($this->env, $context, "partials/alert_error.twig");
            echo "
                        ";
        }
        // line 28
        echo "                        ";
        if (($context["success"] ?? null)) {
            // line 29
            echo "                            ";
            echo twig_include($this->env, $context, "partials/alert_success.twig");
            echo "
                        ";
        }
        // line 31
        echo "                        ";
        $this->displayBlock('content', $context, $blocks);
        // line 32
        echo "                    </div>
                </div>
            </div>
        ";
        // line 35
        echo twig_include($this->env, $context, "partials/footer.twig");
        echo "
    </body>
</html>";
    }

    // line 31
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "./layout/layout_full.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 31,  87 => 35,  82 => 32,  79 => 31,  73 => 29,  70 => 28,  64 => 26,  62 => 25,  54 => 20,  50 => 19,  37 => 9,  33 => 8,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\"/>
        <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"assets/images/apple-icon.png\">
        <link rel=\"icon\" type=\"image/png\" href=\"assets/images/favicon.png\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"/>
        <title>{{pagename}}</title>
        <base href=\"{{i['url']}}/\">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
        <!-- Fonts and icons -->
        <link href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700,200\" rel=\"stylesheet\"/>
        <link href=\"https://use.fontawesome.com/releases/v5.0.6/css/all.css\" rel=\"stylesheet\">
        <!-- CSS Files -->
        <link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"/>
        <link rel=\"stylesheet\" href=\"//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css\">
        <link href=\"assets/css/now-ui-kit.css?v=1.2.0\" rel=\"stylesheet\"/>
    </head>
    <body class=\"{{pagename}} sidebar-collapse menu-on-left\" id=\"page\">
        {{ include('partials/top_bar.twig') }}
        <div class=\"wrapper\">
            <div class=\"page-header clear-filter\">
                <div class=\"content\">
                    <div class=\"container\">
                        {% if (error) %}
                            {{ include('partials/alert_error.twig')}}
                        {% endif %}
                        {% if (success) %}
                            {{ include('partials/alert_success.twig')}}
                        {% endif %}
                        {% block content %}{% endblock %}
                    </div>
                </div>
            </div>
        {{ include('partials/footer.twig') }}
    </body>
</html>", "./layout/layout_full.twig", "C:\\wamp64\\www\\slimar\\views\\layout\\layout_full.twig");
    }
}
