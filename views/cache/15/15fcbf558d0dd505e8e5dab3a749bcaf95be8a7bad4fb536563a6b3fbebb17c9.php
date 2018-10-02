<?php

/* ./layout/layout.twig */
class __TwigTemplate_0fe3f41a5a59008b0f124e9ba904f0db9a34f49b84349f432e7aaabb7b47e030 extends Twig_Template
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
        <!--link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"/-->
        <link href=\"assets/css/now-ui-kit.css\" rel=\"stylesheet\"/>
    </head>

    <body class=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo " sidebar-collapse menu-on-left\" id=\"page\">
        ";
        // line 20
        echo twig_include($this->env, $context, "partials/top_bar.twig");
        echo "
        ";
        // line 21
        echo twig_include($this->env, $context, "partials/breadcrumbs.twig");
        echo "
        <div class=\"wrapper\">
            <div class=\"section\">
                <div class=\"container\">
                    ";
        // line 25
        if ((($context["pagename"] ?? null) == "Profile")) {
            // line 26
            echo "                        ";
            echo twig_include($this->env, $context, "partials/modal.twig");
            echo "
                    ";
        }
        // line 28
        echo "                    <div class=\"row\">
                        <div class=\"d-none d-lg-block col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                            ";
        // line 30
        echo twig_include($this->env, $context, "partials/left_sidebar.twig");
        echo "
                        </div>
                        <div class=\"col-md-8 col-lg-8\">
                            ";
        // line 33
        if (($context["error"] ?? null)) {
            // line 34
            echo "                                ";
            echo twig_include($this->env, $context, "partials/alert_error.twig");
            echo "
                            ";
        }
        // line 36
        echo "                            ";
        if (($context["success"] ?? null)) {
            // line 37
            echo "                                ";
            echo twig_include($this->env, $context, "partials/alert_success.twig");
            echo "
                            ";
        }
        // line 39
        echo "                            <div class=\"container\">
                                <div class=\"row my-3\">                                
                                    <div class=\"col-md-6\"><h2>";
        // line 41
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "</h2></div>
                                    <div class=\"col-md-6\">";
        // line 42
        echo twig_include($this->env, $context, "partials/page_header.twig");
        echo "</div>
                                </div>
                                <div class=\"content-wrapper\">
                                    ";
        // line 45
        $this->displayBlock('content', $context, $blocks);
        // line 46
        echo "                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-4 col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                            ";
        // line 50
        echo twig_include($this->env, $context, "partials/right_sidebar.twig");
        echo "
                        </div>
                    </div>
                </div>
            </div>
            ";
        // line 55
        echo twig_include($this->env, $context, "partials/footer.twig");
        echo "
    </body>
</html>";
    }

    // line 45
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "./layout/layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 45,  130 => 55,  122 => 50,  116 => 46,  114 => 45,  108 => 42,  104 => 41,  100 => 39,  94 => 37,  91 => 36,  85 => 34,  83 => 33,  77 => 30,  73 => 28,  67 => 26,  65 => 25,  58 => 21,  54 => 20,  50 => 19,  37 => 9,  33 => 8,  24 => 1,);
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
        <!--link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"/-->
        <link href=\"assets/css/now-ui-kit.css\" rel=\"stylesheet\"/>
    </head>

    <body class=\"{{pagename}} sidebar-collapse menu-on-left\" id=\"page\">
        {{ include('partials/top_bar.twig') }}
        {{ include('partials/breadcrumbs.twig') }}
        <div class=\"wrapper\">
            <div class=\"section\">
                <div class=\"container\">
                    {% if (pagename == 'Profile') %}
                        {{ include('partials/modal.twig')}}
                    {% endif %}
                    <div class=\"row\">
                        <div class=\"d-none d-lg-block col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                            {{ include('partials/left_sidebar.twig') }}
                        </div>
                        <div class=\"col-md-8 col-lg-8\">
                            {% if (error) %}
                                {{ include('partials/alert_error.twig')}}
                            {% endif %}
                            {% if (success) %}
                                {{ include('partials/alert_success.twig')}}
                            {% endif %}
                            <div class=\"container\">
                                <div class=\"row my-3\">                                
                                    <div class=\"col-md-6\"><h2>{{ pagename }}</h2></div>
                                    <div class=\"col-md-6\">{{ include('partials/page_header.twig') }}</div>
                                </div>
                                <div class=\"content-wrapper\">
                                    {% block content %}{% endblock %}
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-4 col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                            {{ include('partials/right_sidebar.twig') }}
                        </div>
                    </div>
                </div>
            </div>
            {{ include('partials/footer.twig') }}
    </body>
</html>", "./layout/layout.twig", "C:\\wamp64\\www\\slimar\\views\\layout\\layout.twig");
    }
}
