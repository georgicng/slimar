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
        echo " 
    <div class=\"row my-5\">   
        <div class=\"col-md-8 offset-md-2 text-dark\">
            <h2>";
        // line 6
        echo twig_escape_filter($this->env, ($context["pagename"] ?? null), "html", null, true);
        echo "</h2>
            ";
        // line 7
        if (((($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["registeration"] ?? null) : null) == "1")) {
            // line 8
            echo "                <form class=\"form\" method=\"post\">
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label for=\"username\" class=\"sr-only\">Username</label>
                                <input type=\"text\" name=\"username\" id=\"username\" class=\"form-control\" placeholder=\"Username\" value=\"";
            // line 12
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "username", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "username", array())) : ("")), "html", null, true);
            echo "\" required>
                        </div>
                        <div class=\"col form-group\">
                                <label for=\"firstname\" class=\"sr-only\">First name</label>
                                <input type=\"text\" name=\"firstname\" id=\"firstname\" class=\"form-control\" placeholder=\"First name\" value=\"";
            // line 16
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "firstname", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "firstname", array())) : ("")), "html", null, true);
            echo "\" required>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label  for=\"email\" class=\"sr-only\">Email address</label>
                                <input type=\"email\" name=\"email\" id=\"email\"  class=\"form-control\" placeholder=\"Email address\" value=\"";
            // line 22
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "email", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "email", array())) : ("")), "html", null, true);
            echo "\" required>
                        </div>
                        <div class=\"col form-group\">
                                <label for=\"phone\" class=\"sr-only\">Phone</label>
                                <input type=\"text\" name=\"phone\" id=\"phone\" class=\"form-control\" placeholder=\"Enter your phone number\" value=\"";
            // line 26
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "phone", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "phone", array())) : ("")), "html", null, true);
            echo "\" required>                                            
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label for=\"password\" class=\"sr-only\">Password</label>
                                <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" placeholder=\"Password\" required>                                            
                        </div>
                        <div class=\"col form-group\">
                                <label for=\"password2\" class=\"sr-only\">Confirm Password</label>
                                <input type=\"password\" name=\"password2\" name=\"password2\" class=\"form-control\" placeholder=\"Confirm Password\" required>                                            
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label for=\"refer\" class=\"sr-only\">OPTIONAL: Referred by <small>Enter username of user that invited you</small></label>
                                <input type=\"text\" name=\"refer\" id=\"refer\" class=\"form-control\" placeholder=\"Optional: enter username of user that invited you\" value=\"";
            // line 42
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "refer", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "refer", array())) : ("")), "html", null, true);
            echo "\">                                            
                        </div>                        
                        <div class=\"col form-group\">
                            ";
            // line 45
            if (((($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["i"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["captcha_reg"] ?? null) : null) == "1")) {
                // line 46
                echo "                                <img src=\"inc/captcha.php\" style=\"float:left;\"/>
                                <input placeholder='Captcha' style=\"width:170px;padding:9px;color:#272727;\" maxlength=\"4\" name=\"captcha\" type=\"text\">
                            ";
            }
            // line 49
            echo "                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group col-xs-6 col-xs-offset-3\">
                            <div class=\"checkbox\">
                                <label>
                                    <input type=\"checkbox\" name=\"tos\" value=\"1\" /> I agree with the <a href=\"page.php?p=tos\" target=\"__blank\" required>terms and conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"register\" class=\"btn btn-primary btn-block\" value=\"Register\">                                        
                    </div>
                </form> 
            ";
        } else {
            // line 65
            echo "                <div class=\"alert alert-warning\">
                    Registeration is currently closed!
                </div>
            ";
        }
        // line 69
        echo "        </div>
    </div>\t
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
        return array (  130 => 69,  124 => 65,  106 => 49,  101 => 46,  99 => 45,  93 => 42,  74 => 26,  67 => 22,  58 => 16,  51 => 12,  45 => 8,  43 => 7,  39 => 6,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout_full.twig\" %}

{% block content %} 
    <div class=\"row my-5\">   
        <div class=\"col-md-8 offset-md-2 text-dark\">
            <h2>{{ pagename }}</h2>
            {% if (i['registeration'] == \"1\") %}
                <form class=\"form\" method=\"post\">
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label for=\"username\" class=\"sr-only\">Username</label>
                                <input type=\"text\" name=\"username\" id=\"username\" class=\"form-control\" placeholder=\"Username\" value=\"{{ _post.username ? _post.username }}\" required>
                        </div>
                        <div class=\"col form-group\">
                                <label for=\"firstname\" class=\"sr-only\">First name</label>
                                <input type=\"text\" name=\"firstname\" id=\"firstname\" class=\"form-control\" placeholder=\"First name\" value=\"{{ _post.firstname ? _post.firstname }}\" required>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label  for=\"email\" class=\"sr-only\">Email address</label>
                                <input type=\"email\" name=\"email\" id=\"email\"  class=\"form-control\" placeholder=\"Email address\" value=\"{{ _post.email ? _post.email }}\" required>
                        </div>
                        <div class=\"col form-group\">
                                <label for=\"phone\" class=\"sr-only\">Phone</label>
                                <input type=\"text\" name=\"phone\" id=\"phone\" class=\"form-control\" placeholder=\"Enter your phone number\" value=\"{{ _post.phone ? _post.phone }}\" required>                                            
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label for=\"password\" class=\"sr-only\">Password</label>
                                <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" placeholder=\"Password\" required>                                            
                        </div>
                        <div class=\"col form-group\">
                                <label for=\"password2\" class=\"sr-only\">Confirm Password</label>
                                <input type=\"password\" name=\"password2\" name=\"password2\" class=\"form-control\" placeholder=\"Confirm Password\" required>                                            
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col form-group\">
                                <label for=\"refer\" class=\"sr-only\">OPTIONAL: Referred by <small>Enter username of user that invited you</small></label>
                                <input type=\"text\" name=\"refer\" id=\"refer\" class=\"form-control\" placeholder=\"Optional: enter username of user that invited you\" value=\"{{ _post.refer ? _post.refer }}\">                                            
                        </div>                        
                        <div class=\"col form-group\">
                            {% if (i['captcha_reg'] == \"1\") %}
                                <img src=\"inc/captcha.php\" style=\"float:left;\"/>
                                <input placeholder='Captcha' style=\"width:170px;padding:9px;color:#272727;\" maxlength=\"4\" name=\"captcha\" type=\"text\">
                            {% endif %}
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group col-xs-6 col-xs-offset-3\">
                            <div class=\"checkbox\">
                                <label>
                                    <input type=\"checkbox\" name=\"tos\" value=\"1\" /> I agree with the <a href=\"page.php?p=tos\" target=\"__blank\" required>terms and conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"register\" class=\"btn btn-primary btn-block\" value=\"Register\">                                        
                    </div>
                </form> 
            {% else %}
                <div class=\"alert alert-warning\">
                    Registeration is currently closed!
                </div>
            {% endif %}
        </div>
    </div>\t
{% endblock %}", "signup.twig", "C:\\wamp64\\www\\slimar\\views\\signup.twig");
    }
}
