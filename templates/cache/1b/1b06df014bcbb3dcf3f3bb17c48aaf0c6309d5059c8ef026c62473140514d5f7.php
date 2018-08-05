<?php

/* partials/top_bar.twig */
class __TwigTemplate_fa082bdf6fd7ca6fd670ea8f461711dded5095ade60e62803c8d13e01435e5d1 extends Twig_Template
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
        echo "<nav class=\"navbar navbar-default navbar-fixed-top\">
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle offcanvas-toggle\" data-toggle=\"offcanvas\" data-target=\"#bs-example-navbar-collapse-1\" style=\"float:left;\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a href=\"index.php\" class=\"nodecoration\" ><div class=\"logo\">";
        // line 10
        echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["title"] ?? null) : null), "html", null, true);
        echo "</div></a>
    </div>
    <div class=\"hidden-md hidden-lg navbar navbar-default navbar-offcanvas navbar-offcanvas-touch navbar-offcanvas-fade\" id=\"bs-example-navbar-collapse-1\">
      <ul class=\"nav navbar-nav\">
        <li ";
        // line 14
        if ((($context["pagename"] ?? null) == "home")) {
            // line 15
            echo "    class=\"active\"
";
        }
        // line 17
        echo "       <a href=\"index.php\">Home </a></li>
\t\t  ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["index"] => $context["cat"]) {
            // line 19
            echo "          <li><a href=\"cat.php?c=";
            echo twig_escape_filter($this->env, (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = $context["cat"]) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["title"] ?? null) : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = $context["cat"]) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["title"] ?? null) : null), "html", null, true);
            echo "</a></li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['index'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "      </ul>
    </div>
    <ul class=\"nav navbar-nav navbar-right\">

";
        // line 25
        if ( !(($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 = ($context["in"] ?? null)) && is_array($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9) || $__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 instanceof ArrayAccess ? ($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9["username"] ?? null) : null)) {
            // line 26
            echo "        <li class=\"dropdown\">
          <a href=\"#\" class=\"light\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><b>Login</b> <span class=\"caret\"></span></a>
\t\t\t<ul id=\"login-dp\" class=\"dropdown-menu\">
\t\t\t\t<li>
\t\t\t\t\t <div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t\t\t\t <form class=\"form\" method=\"post\" id=\"login-nav\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t <label class=\"sr-only\" for=\"exampleInputEmail2\">Email address</label>
\t\t\t\t\t\t\t\t\t\t\t <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Email address\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t <label class=\"sr-only\" for=\"exampleInputPassword2\">Password</label>
\t\t\t\t\t\t\t\t\t\t\t <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\" required>

\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
                                                    ";
            // line 45
            if (((($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 = ($context["i"] ?? null)) && is_array($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217) || $__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 instanceof ArrayAccess ? ($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217["captcha"] ?? null) : null) == "1")) {
                // line 46
                echo "       
\t\t\t\t\t\t\t\t\t\t\t<img src=\"inc/captcha.php\" style=\"float:left;\"/>
\t\t\t\t\t\t\t\t\t\t\t<input placeholder='Captcha' maxlength=\"4\" style=\"width:170px;padding:9px;color:#272727;\"  name=\"captcha\" type=\"text\">
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 50
            echo "
                                             <div class=\"help-block text-right forgotpass\"><a href=\"forgotpass.php\">Forget the password ?</a></div>
\t\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t <input type=\"submit\" name=\"login\" class=\"btn btn-pink btn-block\" value=\"Login\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t <label>
\t\t\t\t\t\t\t\t\t\t\t <input type=\"checkbox\" name=\"remember\"> Remember me</input>
\t\t\t\t\t\t\t\t\t\t\t </label>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t </form>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t </div>
\t\t\t\t</li>
\t\t\t</ul>
        </li>
        <li><a href=\"signup.php\">REGISTER</a></li>
\t\t</ul>

";
        } else {
            // line 73
            if ((($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 = ($context["in_perm"] ?? null)) && is_array($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105) || $__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 instanceof ArrayAccess ? ($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105["has_admin"] ?? null) : null)) {
                // line 74
                echo "            <li class=\"dark\"><a class=\"dark\" href=\"admin/\">Admin panel</a></li>";
            }
            // line 75
            echo "\t<li class=\"dropdown\">
          <a href=\"#\" class=\"light\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
\t\t\t<img src=\"";
            // line 77
            echo twig_escape_filter($this->env, ($context["profilepic"] ?? null), "html", null, true);
            echo "\" class=\"profilepic\" width=\"25px\" height=\"25px\">
\t\t\t<b>";
            // line 78
            echo twig_escape_filter($this->env, (($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 = ($context["in"] ?? null)) && is_array($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779) || $__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 instanceof ArrayAccess ? ($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779["username"] ?? null) : null), "html", null, true);
            echo "</b> <span class=\"caret\"></span></a>
\t\t\t<ul class=\"dropdown-menu\">
\t\t\t<li><a class=\"white\" href=\"profile.php?u=";
            // line 80
            echo twig_escape_filter($this->env, (($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 = ($context["in"] ?? null)) && is_array($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1) || $__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 instanceof ArrayAccess ? ($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1["username"] ?? null) : null), "html", null, true);
            echo "\">My profile</a></li>
\t\t\t<li><a class=\"white\" href=\"account_settings.php\">Account settings</a></li>
            <li role=\"separator\" class=\"divider\"></li>
\t\t\t<li><a class=\"white\" href=\"logout.php\">Logout</a></li>
          </ul>
\t</li>
";
        }
        // line 87
        echo "  </div>
</nav>
<div class=\"bs-example\">
    <ul class=\"breadcrumb\">
        <li><a href=\"#\">Home</a></li>
        <li><a href=\"#\">Products</a></li>
        <li class=\"active\">Accessories</li>
    </ul>
</div>

";
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
        return array (  155 => 87,  145 => 80,  140 => 78,  136 => 77,  132 => 75,  129 => 74,  127 => 73,  102 => 50,  96 => 46,  94 => 45,  73 => 26,  71 => 25,  65 => 21,  54 => 19,  50 => 18,  47 => 17,  43 => 15,  41 => 14,  34 => 10,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<nav class=\"navbar navbar-default navbar-fixed-top\">
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle offcanvas-toggle\" data-toggle=\"offcanvas\" data-target=\"#bs-example-navbar-collapse-1\" style=\"float:left;\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a href=\"index.php\" class=\"nodecoration\" ><div class=\"logo\">{{i['title']}}</div></a>
    </div>
    <div class=\"hidden-md hidden-lg navbar navbar-default navbar-offcanvas navbar-offcanvas-touch navbar-offcanvas-fade\" id=\"bs-example-navbar-collapse-1\">
      <ul class=\"nav navbar-nav\">
        <li {% if (pagename == \"home\") %}
    class=\"active\"
{% endif %}
       <a href=\"index.php\">Home </a></li>
\t\t  {% for index, cat in categories %}
          <li><a href=\"cat.php?c={{ cat['title'] }}\">{{ cat['title'] }}</a></li>
\t\t\t\t{% endfor %}
      </ul>
    </div>
    <ul class=\"nav navbar-nav navbar-right\">

{% if (not in['username']) %}
        <li class=\"dropdown\">
          <a href=\"#\" class=\"light\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><b>Login</b> <span class=\"caret\"></span></a>
\t\t\t<ul id=\"login-dp\" class=\"dropdown-menu\">
\t\t\t\t<li>
\t\t\t\t\t <div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t\t\t\t <form class=\"form\" method=\"post\" id=\"login-nav\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t <label class=\"sr-only\" for=\"exampleInputEmail2\">Email address</label>
\t\t\t\t\t\t\t\t\t\t\t <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Email address\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t <label class=\"sr-only\" for=\"exampleInputPassword2\">Password</label>
\t\t\t\t\t\t\t\t\t\t\t <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\" required>

\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
                                                    {% if (i['captcha'] == \"1\") %}
       
\t\t\t\t\t\t\t\t\t\t\t<img src=\"inc/captcha.php\" style=\"float:left;\"/>
\t\t\t\t\t\t\t\t\t\t\t<input placeholder='Captcha' maxlength=\"4\" style=\"width:170px;padding:9px;color:#272727;\"  name=\"captcha\" type=\"text\">
\t\t\t\t\t\t\t\t\t\t\t{% endif %}

                                             <div class=\"help-block text-right forgotpass\"><a href=\"forgotpass.php\">Forget the password ?</a></div>
\t\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t <input type=\"submit\" name=\"login\" class=\"btn btn-pink btn-block\" value=\"Login\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">
\t\t\t\t\t\t\t\t\t\t\t <label>
\t\t\t\t\t\t\t\t\t\t\t <input type=\"checkbox\" name=\"remember\"> Remember me</input>
\t\t\t\t\t\t\t\t\t\t\t </label>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t </form>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t </div>
\t\t\t\t</li>
\t\t\t</ul>
        </li>
        <li><a href=\"signup.php\">REGISTER</a></li>
\t\t</ul>

{% else %}
{% if (in_perm['has_admin']) %}
            <li class=\"dark\"><a class=\"dark\" href=\"admin/\">Admin panel</a></li>{% endif %}
\t<li class=\"dropdown\">
          <a href=\"#\" class=\"light\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
\t\t\t<img src=\"{{profilepic}}\" class=\"profilepic\" width=\"25px\" height=\"25px\">
\t\t\t<b>{{in['username']}}</b> <span class=\"caret\"></span></a>
\t\t\t<ul class=\"dropdown-menu\">
\t\t\t<li><a class=\"white\" href=\"profile.php?u={{in['username']}}\">My profile</a></li>
\t\t\t<li><a class=\"white\" href=\"account_settings.php\">Account settings</a></li>
            <li role=\"separator\" class=\"divider\"></li>
\t\t\t<li><a class=\"white\" href=\"logout.php\">Logout</a></li>
          </ul>
\t</li>
{% endif %}
  </div>
</nav>
<div class=\"bs-example\">
    <ul class=\"breadcrumb\">
        <li><a href=\"#\">Home</a></li>
        <li><a href=\"#\">Products</a></li>
        <li class=\"active\">Accessories</li>
    </ul>
</div>

", "partials/top_bar.twig", "C:\\xampp\\htdocs\\slimar\\templates\\partials\\top_bar.twig");
    }
}
