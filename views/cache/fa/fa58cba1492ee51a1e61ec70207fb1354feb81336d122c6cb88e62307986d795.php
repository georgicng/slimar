<?php

/* partials/top_bar.twig */
class __TwigTemplate_28397253cc38ffc21846b004f92536e4354356a60344fff71785564eb22a2fda extends Twig_Template
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
        echo "<nav class=\"navbar navbar-expand-lg bg-primary fixed-top\">
    <div class=\"container\">
            <button class=\"navbar-toggler navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navigation\" aria-controls=\"navigation-index\" aria-expanded=\"true\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-bar top-bar\"></span>
                    <span class=\"navbar-toggler-bar middle-bar\"></span>
                    <span class=\"navbar-toggler-bar bottom-bar\"></span>
                </button>
        <a class=\"navbar-brand\" href=\"index.php\" rel=\"tooltip\" title=\"\" data-placement=\"bottom\" data-original-title=\"Chapgames Inc\">
            ";
        // line 9
        echo "<img src=\"assets/images/logo.png\" />
        </a>

        <ul class=\"navbar-nav bd-navbar-nav flex-row ml-auto\">
            ";
        // line 13
        if ( !(($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["in"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["username"] ?? null) : null)) {
            // line 14
            echo "                <li class=\"nav-item\">
                    <a href=\"login.php\" class=\"nav-link\">LOGIN</a>
                </li>
                <li class=\"nav-item\">
                    <a href=\"signup.php\" class=\"nav-link\">REGISTER</a>
                </li>
            ";
        } else {
            // line 20
            echo "               
                <li class=\"nav-item d-none d-sm-inline\">
                    <a href=\"#\" class=\"nav-link font-weight-bold\">
                        <span class=\"currency symbol\">N </span><span id=\"user-balance\" class=\"balance money\">";
            // line 23
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["in"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["balance"] ?? null) : null), 2, ".", ","), "html", null, true);
            echo "</span>
                        <span class=\"caret\"></span>
                    </a>
                </li>                
                <li class=\"nav-item d-none d-sm-inline\"><a href=\"credit.php\" class=\"nav-link font-weight-bold\">Load Credit</a></li>
                <li class=\"nav-item dropdown overflow\">
                    <a href=\"#\" class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\">
                        <img src=\"";
            // line 30
            echo twig_escape_filter($this->env, ($context["profilepic"] ?? null), "html", null, true);
            echo "\" class=\"profilepic\" width=\"25px\" height=\"25px\">
                        <b>user</b>
                        <span class=\"caret\"></span></a>
                    <div class=\"dropdown-menu\">
                        <a href=\"#\" class=\"d-sm-none dropdown-item font-weight-bold\">
                                <span class=\"currency symbol\">N </span><span id=\"user-balance\" class=\"balance money\">";
            // line 35
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = ($context["in"] ?? null)) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["balance"] ?? null) : null), 2, ".", ","), "html", null, true);
            echo "</span>
                                <span class=\"caret\"></span>
                            </a>                        
                        <a class=\"dropdown-item\" href=\"profile.php\">My profile</a>
                        <a href=\"credit.php\" class=\"d-sm-none dropdown-item\">Load Credit</a>                        
                        <a href=\"payout.php\" class=\"dropdown-item\">Request Payout</a>
                        <a href=\"stat.php\" class=\"dropdown-item\">Play History</a>
                        ";
            // line 42
            if ((($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 = ($context["in_perm"] ?? null)) && is_array($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9) || $__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 instanceof ArrayAccess ? ($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9["has_admin"] ?? null) : null)) {
                // line 43
                echo "                        <a class=\"dropdown-item\" href=\"admin/\">Admin panel</a>
                        ";
            }
            // line 45
            echo "                        <a class=\"dropdown-item\" href=\"logout.php\">Logout</a>
                    </div>
                </li>
            ";
        }
        // line 49
        echo "        </ul>
        <div class=\"navbar-collapse justify-content-end d-lg-none\" id=\"navigation\" data-nav-image=\"../assets/img/blurred-image-1.jpg\">
            ";
        // line 51
        echo twig_get_attribute($this->env, $this->source, ($context["header_menu"] ?? null), "html", array(), "method");
        echo "
        </div>
    </div>
</nav>";
    }

    public function getTemplateName()
    {
        return "partials/top_bar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 51,  95 => 49,  89 => 45,  85 => 43,  83 => 42,  73 => 35,  65 => 30,  55 => 23,  50 => 20,  41 => 14,  39 => 13,  33 => 9,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"navbar navbar-expand-lg bg-primary fixed-top\">
    <div class=\"container\">
            <button class=\"navbar-toggler navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navigation\" aria-controls=\"navigation-index\" aria-expanded=\"true\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-bar top-bar\"></span>
                    <span class=\"navbar-toggler-bar middle-bar\"></span>
                    <span class=\"navbar-toggler-bar bottom-bar\"></span>
                </button>
        <a class=\"navbar-brand\" href=\"index.php\" rel=\"tooltip\" title=\"\" data-placement=\"bottom\" data-original-title=\"Chapgames Inc\">
            {# i['title'] #}<img src=\"assets/images/logo.png\" />
        </a>

        <ul class=\"navbar-nav bd-navbar-nav flex-row ml-auto\">
            {% if (not in['username']) %}
                <li class=\"nav-item\">
                    <a href=\"login.php\" class=\"nav-link\">LOGIN</a>
                </li>
                <li class=\"nav-item\">
                    <a href=\"signup.php\" class=\"nav-link\">REGISTER</a>
                </li>
            {% else %}               
                <li class=\"nav-item d-none d-sm-inline\">
                    <a href=\"#\" class=\"nav-link font-weight-bold\">
                        <span class=\"currency symbol\">N </span><span id=\"user-balance\" class=\"balance money\">{{in['balance']|number_format(2, '.', ',')}}</span>
                        <span class=\"caret\"></span>
                    </a>
                </li>                
                <li class=\"nav-item d-none d-sm-inline\"><a href=\"credit.php\" class=\"nav-link font-weight-bold\">Load Credit</a></li>
                <li class=\"nav-item dropdown overflow\">
                    <a href=\"#\" class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\">
                        <img src=\"{{profilepic}}\" class=\"profilepic\" width=\"25px\" height=\"25px\">
                        <b>user</b>
                        <span class=\"caret\"></span></a>
                    <div class=\"dropdown-menu\">
                        <a href=\"#\" class=\"d-sm-none dropdown-item font-weight-bold\">
                                <span class=\"currency symbol\">N </span><span id=\"user-balance\" class=\"balance money\">{{in['balance']|number_format(2, '.', ',')}}</span>
                                <span class=\"caret\"></span>
                            </a>                        
                        <a class=\"dropdown-item\" href=\"profile.php\">My profile</a>
                        <a href=\"credit.php\" class=\"d-sm-none dropdown-item\">Load Credit</a>                        
                        <a href=\"payout.php\" class=\"dropdown-item\">Request Payout</a>
                        <a href=\"stat.php\" class=\"dropdown-item\">Play History</a>
                        {% if (in_perm['has_admin']) %}
                        <a class=\"dropdown-item\" href=\"admin/\">Admin panel</a>
                        {% endif %}
                        <a class=\"dropdown-item\" href=\"logout.php\">Logout</a>
                    </div>
                </li>
            {% endif %}
        </ul>
        <div class=\"navbar-collapse justify-content-end d-lg-none\" id=\"navigation\" data-nav-image=\"../assets/img/blurred-image-1.jpg\">
            {{ header_menu.html() | raw }}
        </div>
    </div>
</nav>", "partials/top_bar.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\top_bar.twig");
    }
}
