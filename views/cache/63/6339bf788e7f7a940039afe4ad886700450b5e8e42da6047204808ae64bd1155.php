<?php

/* signup.twig */
class __TwigTemplate_534933b2b373653296a6a686eede2e462a389a5129cd84edf1678c7caed24ab8 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout_full.twig", "signup.twig", 1);
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
        echo "    <div class=\"row my-3\">
        <div class=\"col-md-8 offset-md-2 text-dark\">
            <h2>";
        // line 6
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "</h2>
            ";
        // line 7
        if (((($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["registeration"] ?? null) : null) == "1")) {
            // line 8
            echo "                <form class=\"form\" method=\"post\" class=\"text-left\">
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"username\" class=\"sr-only\">Username</label>
                                <input type=\"text\" name=\"username\" id=\"username\" class=\"form-control\" placeholder=\"Username\" value=\"";
            // line 13
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "username", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "username", array())) : ("")), "html", null, true);
            echo "\" required=\"required\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"firstname\" class=\"sr-only\">First name</label>
                                <input type=\"text\" name=\"firstname\" id=\"firstname\" class=\"form-control\" placeholder=\"Name\" value=\"";
            // line 19
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "firstname", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "firstname", array())) : ("")), "html", null, true);
            echo "\" required=\"required\">
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"email\" class=\"sr-only\">Email address</label>
                                <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\" placeholder=\"Email address\" value=\"";
            // line 27
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "email", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "email", array())) : ("")), "html", null, true);
            echo "\" required=\"required\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"phone\" class=\"sr-only\">Phone</label>
                                <input type=\"text\" name=\"phone\" id=\"phone\" class=\"form-control\" placeholder=\"Enter your phone number\" value=\"";
            // line 33
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "phone", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "phone", array())) : ("")), "html", null, true);
            echo "\" required=\"required\">
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"password\" class=\"sr-only\">Password</label>
                                <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" placeholder=\"Password\" required=\"required\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"password2\" class=\"sr-only\">Confirm Password</label>
                                <input type=\"password\" name=\"password2\" class=\"form-control\" placeholder=\"Confirm Password\" required=\"required\">
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"refer\" class=\"sr-only\">OPTIONAL: Referred by
                                    <small>Enter username of user that invited you</small>
                                </label>
                                <input type=\"text\" name=\"refer\" id=\"refer\" class=\"form-control\" placeholder=\"Optional: enter username of user that invited you\" value=\"";
            // line 57
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "refer", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "refer", array())) : ("")), "html", null, true);
            echo "\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                ";
            // line 62
            if (((($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["i"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["captcha_reg"] ?? null) : null) == "1")) {
                // line 63
                echo "                                    <img src=\"inc/captcha.php\" style=\"float:left;\"/>
                                    <input placeholder='Captcha' style=\"width:170px;padding:9px;color:#272727;\" maxlength=\"4\" name=\"captcha\" type=\"text\">
                                ";
            }
            // line 66
            echo "                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <div class=\"form-group\">
                                <div class=\"custom-control custom-checkbox\">
                                    <input type=\"checkbox\" class=\"custom-control-input\" id=\"tos\" name=\"tos\" value=\"1\"/>
                                    <label class=\"custom-control-label\" for=\"tos\">
                                        I agree with the
                                        <a href=\"page.php?p=tos\" target=\"__blank\" required=\"required\">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <div class=\"form-group\">
                                <input type=\"submit\" name=\"register\" class=\"btn btn-primary btn-block\" value=\"Register\">
                            </div>
                        </div>
                    </div>
                </form>
            ";
        } else {
            // line 91
            echo "                <div class=\"alert alert-warning\">
                    Registeration is currently closed!
                </div>
            ";
        }
        // line 95
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "signup.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 95,  150 => 91,  123 => 66,  118 => 63,  116 => 62,  108 => 57,  81 => 33,  72 => 27,  61 => 19,  52 => 13,  45 => 8,  43 => 7,  39 => 6,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout_full.twig\" %}

{% block content %}
    <div class=\"row my-3\">
        <div class=\"col-md-8 offset-md-2 text-dark\">
            <h2>{{ pagename }}</h2>
            {% if (i['registeration'] == \"1\") %}
                <form class=\"form\" method=\"post\" class=\"text-left\">
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"username\" class=\"sr-only\">Username</label>
                                <input type=\"text\" name=\"username\" id=\"username\" class=\"form-control\" placeholder=\"Username\" value=\"{{ _post.username ? _post.username }}\" required=\"required\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"firstname\" class=\"sr-only\">First name</label>
                                <input type=\"text\" name=\"firstname\" id=\"firstname\" class=\"form-control\" placeholder=\"Name\" value=\"{{ _post.firstname ? _post.firstname }}\" required=\"required\">
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"email\" class=\"sr-only\">Email address</label>
                                <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\" placeholder=\"Email address\" value=\"{{ _post.email ? _post.email }}\" required=\"required\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"phone\" class=\"sr-only\">Phone</label>
                                <input type=\"text\" name=\"phone\" id=\"phone\" class=\"form-control\" placeholder=\"Enter your phone number\" value=\"{{ _post.phone ? _post.phone }}\" required=\"required\">
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"password\" class=\"sr-only\">Password</label>
                                <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" placeholder=\"Password\" required=\"required\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"password2\" class=\"sr-only\">Confirm Password</label>
                                <input type=\"password\" name=\"password2\" class=\"form-control\" placeholder=\"Confirm Password\" required=\"required\">
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                <label for=\"refer\" class=\"sr-only\">OPTIONAL: Referred by
                                    <small>Enter username of user that invited you</small>
                                </label>
                                <input type=\"text\" name=\"refer\" id=\"refer\" class=\"form-control\" placeholder=\"Optional: enter username of user that invited you\" value=\"{{ _post.refer ? _post.refer }}\">
                            </div>
                        </div>
                        <div class=\"col-lg-6\">
                            <div class=\"form-group\">
                                {% if (i['captcha_reg'] == \"1\") %}
                                    <img src=\"inc/captcha.php\" style=\"float:left;\"/>
                                    <input placeholder='Captcha' style=\"width:170px;padding:9px;color:#272727;\" maxlength=\"4\" name=\"captcha\" type=\"text\">
                                {% endif %}
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <div class=\"form-group\">
                                <div class=\"custom-control custom-checkbox\">
                                    <input type=\"checkbox\" class=\"custom-control-input\" id=\"tos\" name=\"tos\" value=\"1\"/>
                                    <label class=\"custom-control-label\" for=\"tos\">
                                        I agree with the
                                        <a href=\"page.php?p=tos\" target=\"__blank\" required=\"required\">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <div class=\"form-group\">
                                <input type=\"submit\" name=\"register\" class=\"btn btn-primary btn-block\" value=\"Register\">
                            </div>
                        </div>
                    </div>
                </form>
            {% else %}
                <div class=\"alert alert-warning\">
                    Registeration is currently closed!
                </div>
            {% endif %}
        </div>
    </div>
{% endblock %}", "signup.twig", "C:\\wamp64\\www\\slimar\\views\\signup.twig");
    }
}
