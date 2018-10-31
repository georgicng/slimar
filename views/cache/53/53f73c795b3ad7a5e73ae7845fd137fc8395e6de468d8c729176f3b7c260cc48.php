<?php

/* login.twig */
class __TwigTemplate_2d2d613ae2e917497a010cb59d6472cee1e28f9a777c288467959fbec588f2a7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout_full.twig", "login.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "./layout/layout_full.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"col-md-8 col-lg-6 ml-auto mr-auto\">
        ";
        // line 5
        if (($context["verified"] ?? null)) {
            // line 6
            echo "            ";
            if ((($context["verified"] ?? null) == "true")) {
                // line 7
                echo "            <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
                <strong>SUCCESS:</strong> Your email has been verified.
            </div>
            ";
            } else {
                // line 11
                echo "            <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
                We could not verify your email.
            </div>
            ";
            }
            // line 15
            echo "        ";
        }
        // line 16
        echo "        ";
        if (($context["created"] ?? null)) {
            // line 17
            echo "        <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
            <strong>SUCCESS:</strong> Your account has been created.
        </div>
        ";
        }
        // line 21
        echo "        <div class=\"card card-login card-plain text-left\">
            <form class=\"form\" method=\"post\" id=\"login-nav\">
                <div class=\"card-header text-center text-dark\">
                    <h2>";
        // line 24
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "</h2>
                </div>
                <div class=\"card-body\">
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"email\">Email address</label>
                        <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\" placeholder=\"Email address\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"password\">Password</label>
                        <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" placeholder=\"Password\" required=\"required\">
                    </div>
                    
                    ";
        // line 36
        if (((($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["captcha"] ?? null) : null) == "1")) {
            // line 37
            echo "                    <div class=\"form-group\">
                        <img src=\"inc/captcha.php\" style=\"float:left;\"/>
                        <input placeholder='Captcha' style=\"width:170px;padding:9px;color:#272727;\" maxlength=\"4\" name=\"captcha\" type=\"text\">
                    </div>
                    ";
        }
        // line 42
        echo "                </div>
                <div class=\"card-footer text-dark\">
                        <div class=\"custom-control custom-checkbox\">
                            <input type=\"checkbox\" tabindex=\"3\" class=\"custom-control-input\" name=\"remember\" id=\"remember\">
                            <label for=\"remember\" class=\"custom-control-label\">Remember Me</label>
                        </div>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"login\" class=\"btn btn-primary btn-block\" value=\"Login\">
                    </div>
                    <div class=\"d-flex justify-content-between\">
                        <a href=\"signup.php\">Register</a>
                        <a href=\"forgotpass.php\">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 42,  89 => 37,  87 => 36,  72 => 24,  67 => 21,  61 => 17,  58 => 16,  55 => 15,  49 => 11,  43 => 7,  40 => 6,  38 => 5,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout_full.twig\" %}

{% block content %}
    <div class=\"col-md-8 col-lg-6 ml-auto mr-auto\">
        {% if verified %}
            {% if (verified == 'true') %}
            <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
                <strong>SUCCESS:</strong> Your email has been verified.
            </div>
            {% else %}
            <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
                We could not verify your email.
            </div>
            {% endif %}
        {% endif %}
        {% if (created) %}
        <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
            <strong>SUCCESS:</strong> Your account has been created.
        </div>
        {% endif %}
        <div class=\"card card-login card-plain text-left\">
            <form class=\"form\" method=\"post\" id=\"login-nav\">
                <div class=\"card-header text-center text-dark\">
                    <h2>{{ pagename }}</h2>
                </div>
                <div class=\"card-body\">
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"email\">Email address</label>
                        <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\" placeholder=\"Email address\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"password\">Password</label>
                        <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" placeholder=\"Password\" required=\"required\">
                    </div>
                    
                    {% if (i['captcha'] == \"1\") %}
                    <div class=\"form-group\">
                        <img src=\"inc/captcha.php\" style=\"float:left;\"/>
                        <input placeholder='Captcha' style=\"width:170px;padding:9px;color:#272727;\" maxlength=\"4\" name=\"captcha\" type=\"text\">
                    </div>
                    {% endif %}
                </div>
                <div class=\"card-footer text-dark\">
                        <div class=\"custom-control custom-checkbox\">
                            <input type=\"checkbox\" tabindex=\"3\" class=\"custom-control-input\" name=\"remember\" id=\"remember\">
                            <label for=\"remember\" class=\"custom-control-label\">Remember Me</label>
                        </div>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"login\" class=\"btn btn-primary btn-block\" value=\"Login\">
                    </div>
                    <div class=\"d-flex justify-content-between\">
                        <a href=\"signup.php\">Register</a>
                        <a href=\"forgotpass.php\">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
{% endblock %}", "login.twig", "C:\\wamp64\\www\\slimar\\views\\login.twig");
    }
}
