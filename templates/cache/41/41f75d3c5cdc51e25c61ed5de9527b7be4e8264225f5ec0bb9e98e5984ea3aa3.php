<?php

/* ./layout/layout.twig */
class __TwigTemplate_2ee19fe33bbcf456ee52772702c1f4377ea2205ae3c2cbf541bd481028004323 extends Twig_Template
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
\t<head>
        <title>";
        // line 4
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "</title>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\" />
        <link rel=\"stylesheet\" href=\"files/css/global.css\">
        <link rel=\"stylesheet\" href=\"files/css/theme_light.css\">
        <link href=\"files/css/main.css\" rel=\"stylesheet\" />
        <link href=\"files/css/bootstrap.offcanvas.min.css\" rel=\"stylesheet\" />
        <link href=\"http://fontawesome.io/assets/font-awesome/css/font-awesome.css\" rel=\"stylesheet\" />
        <script src=\"https://code.jquery.com/jquery-3.1.1.min.js\" defer></script>
        <script src=\"https://vsn4ik.github.io/bootstrap-checkbox/dist/js/bootstrap-checkbox.js\" defer></script>
        <!--script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script-->
\t</head>

\t<body class=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "\" id=\"page\">
    ";
        // line 18
        echo twig_include($this->env, $context, "partials/top_bar.twig");
        echo "
\t\t<div class=\"container\">\t\t
            ";
        // line 20
        if ((($context["pagename"] ?? null) == "Profile")) {
            // line 21
            echo "                ";
            echo twig_include($this->env, $context, "partials/modal.twig");
            echo "
            ";
        }
        // line 23
        echo "\t\t\t<div class=\"row\">
                <div class=\"visible-lg-2 col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                    ";
        // line 25
        echo twig_include($this->env, $context, "partials/left_sidebar.twig");
        echo "
                </div>
                <div class=\"col-md-8 col-lg-8 contentbg\" style=\"padding:10px;\">
                    ";
        // line 28
        if (($context["error"] ?? null)) {
            // line 29
            echo "                        ";
            echo twig_include($this->env, $context, "partials/alert_error.twig");
            echo "
                    ";
        }
        // line 31
        echo "                    ";
        if (($context["success"] ?? null)) {
            // line 32
            echo "                        ";
            echo twig_include($this->env, $context, "partials/alert_success.twig");
            echo "
                    ";
        }
        // line 33
        echo "\t\t\t\t
                    <div class=\"contentcontainer\" style=\"\">
                        <div class=\"col-md-6\">";
        // line 35
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "</div><div class=\"col-md-6\">";
        echo twig_include($this->env, $context, "partials/page_header.twig");
        echo "</div>
                        <div class=\"content-container\">
                            ";
        // line 37
        $this->displayBlock('content', $context, $blocks);
        // line 38
        echo "                        </div>
                    </div>\t\t\t\t
                </div>\t\t\t  
                <div class=\"col-md-4 col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                    ";
        // line 42
        echo twig_include($this->env, $context, "partials/right_sidebar.twig");
        echo "
                </div>
\t\t\t</div>
\t\t</div>
\t\t";
        // line 46
        echo twig_include($this->env, $context, "partials/footer.twig");
        echo "\t
\t</body>
</html>";
    }

    // line 37
    public function block_content($context, array $blocks = array())
    {
        echo " ";
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
        return array (  122 => 37,  115 => 46,  108 => 42,  102 => 38,  100 => 37,  93 => 35,  89 => 33,  83 => 32,  80 => 31,  74 => 29,  72 => 28,  66 => 25,  62 => 23,  56 => 21,  54 => 20,  49 => 18,  45 => 17,  29 => 4,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
\t<head>
        <title>{{pagename}}</title>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\" />
        <link rel=\"stylesheet\" href=\"files/css/global.css\">
        <link rel=\"stylesheet\" href=\"files/css/theme_light.css\">
        <link href=\"files/css/main.css\" rel=\"stylesheet\" />
        <link href=\"files/css/bootstrap.offcanvas.min.css\" rel=\"stylesheet\" />
        <link href=\"http://fontawesome.io/assets/font-awesome/css/font-awesome.css\" rel=\"stylesheet\" />
        <script src=\"https://code.jquery.com/jquery-3.1.1.min.js\" defer></script>
        <script src=\"https://vsn4ik.github.io/bootstrap-checkbox/dist/js/bootstrap-checkbox.js\" defer></script>
        <!--script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script-->
\t</head>

\t<body class=\"{{pagename}}\" id=\"page\">
    {{ include('partials/top_bar.twig') }}
\t\t<div class=\"container\">\t\t
            {% if (pagename == 'Profile') %}
                {{ include('partials/modal.twig')}}
            {% endif %}
\t\t\t<div class=\"row\">
                <div class=\"visible-lg-2 col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                    {{ include('partials/left_sidebar.twig') }}
                </div>
                <div class=\"col-md-8 col-lg-8 contentbg\" style=\"padding:10px;\">
                    {% if (error) %}
                        {{ include('partials/alert_error.twig')}}
                    {% endif %}
                    {% if (success) %}
                        {{ include('partials/alert_success.twig')}}
                    {% endif %}\t\t\t\t
                    <div class=\"contentcontainer\" style=\"\">
                        <div class=\"col-md-6\">{{ pagename }}</div><div class=\"col-md-6\">{{ include('partials/page_header.twig') }}</div>
                        <div class=\"content-container\">
                            {% block content %} {% endblock %}
                        </div>
                    </div>\t\t\t\t
                </div>\t\t\t  
                <div class=\"col-md-4 col-lg-2\" style=\"padding:10px;padding-top:0px;\">
                    {{ include('partials/right_sidebar.twig') }}
                </div>
\t\t\t</div>
\t\t</div>
\t\t{{ include('partials/footer.twig') }}\t
\t</body>
</html>", "./layout/layout.twig", "C:\\xampp\\htdocs\\slimar\\templates\\layout\\layout.twig");
    }
}
