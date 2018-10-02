<?php

/* play.twig */
class __TwigTemplate_8602b2c5302d7356f62207a5c69429fab7e3807fe70d3ddbd809fd9b3c094042 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout.twig", "play.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "./layout/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"content\">
    ";
        // line 5
        if ( !(($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["cur_game"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["file"] ?? null) : null)) {
            // line 6
            echo "        <div class=\"alert alert-warning\">No game file has been added for this game. If you are an administrator you can edit this by the administration
            panel.</div>
    ";
        } else {
            // line 9
            echo "        <div class=\"game-bar\" id=\"gameheader\">
            <div class=\"pull-right\">
                <button onclick=\"goFullscreen('player'); return false\" style=\"background:none;border:none;color:white;\">
                    <i class=\"fa fa-arrows-alt\" aria-hidden=\"true\"></i> Fullscreen
                </button>
            </div>
        </div>
        <div class=\"w-100 mb-3\">            
            ";
            // line 17
            if (((($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["cur_game"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["type"] ?? null) : null) == "Flash")) {
                // line 18
                echo "                <object class=\"embed-responsive embed-responsive-16by9\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" id=\"myFlashContent\">
                    <param name=\"movie\" value=\"";
                // line 19
                echo twig_escape_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = ($context["cur_game"] ?? null)) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["file"] ?? null) : null), "html", null, true);
                echo "\">
                    <!--[if !IE]>-->
                    <object type=\"application/x-shockwave-flash\" data=\"";
                // line 21
                echo twig_escape_filter($this->env, (($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 = ($context["cur_game"] ?? null)) && is_array($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9) || $__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 instanceof ArrayAccess ? ($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9["file"] ?? null) : null), "html", null, true);
                echo "\">
                        <!--<![endif]-->
                        <a href=\"http://www.adobe.com/go/getflashplayer\">
                            <img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\">
                        </a>
                        <!-- [if !IE]>-->
                    </object>
                    <!--<![endif]-->
                </object>
            ";
            } elseif (((($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 =             // line 30
($context["cur_game"] ?? null)) && is_array($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217) || $__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 instanceof ArrayAccess ? ($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217["type"] ?? null) : null) == "HTML5")) {
                // line 31
                echo "                <div class=\"embed-responsive embed-responsive-16by9\">
                    ";
                // line 32
                echo (($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 = ($context["cur_game"] ?? null)) && is_array($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105) || $__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 instanceof ArrayAccess ? ($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105["file"] ?? null) : null);
                echo "
                </div>
            ";
            } elseif (((($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 =             // line 34
($context["cur_game"] ?? null)) && is_array($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779) || $__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 instanceof ArrayAccess ? ($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779["type"] ?? null) : null) == "HTML5-url")) {
                // line 35
                echo "                <!-- 16:9 aspect ratio -->
                <div class=\"embed-responsive embed-responsive-16by9\">
                    <iframe class=\"embed-responsive\" width=\"100%\" src=\"";
                // line 37
                echo twig_escape_filter($this->env, (($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 = ($context["cur_game"] ?? null)) && is_array($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1) || $__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 instanceof ArrayAccess ? ($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1["file"] ?? null) : null), "html", null, true);
                echo "\"></iframe>
                </div>
            ";
            }
            // line 40
            echo "        </div>
    ";
        }
        // line 42
        echo "    ";
        if ((($__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0 = ($context["cur_game"] ?? null)) && is_array($__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0) || $__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0 instanceof ArrayAccess ? ($__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0["id"] ?? null) : null)) {
            // line 43
            echo "    <div class=\"card card-nav-tabs card-plain\">
        <div class=\"card-header card-header-danger\">
            <!-- colors: \"header-primary\", \"header-info\", \"header-success\", \"header-warning\", \"header-danger\" -->
            <div class=\"nav-tabs-navigation\">
                <div class=\"nav-tabs-wrapper\">
                    <ul class=\"nav nav-tabs\" data-tabs=\"tabs\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link active\" href=\"#description\" data-toggle=\"tab\">Description</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"#gameplay\" data-toggle=\"tab\">How to Play</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class=\"card-body \">
            <div class=\"tab-content text-center\">
                <div class=\"tab-pane active\" id=\"description\">
                    <div class=\"description-text\">";
            // line 62
            echo (($__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866 = ($context["cur_game"] ?? null)) && is_array($__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866) || $__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866 instanceof ArrayAccess ? ($__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866["description"] ?? null) : null);
            echo "</div>
                </div>
                <div class=\"tab-pane\" id=\"gameplay\">
                    <div class=\"description-text\">";
            // line 65
            echo (($__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f = ($context["cur_game"] ?? null)) && is_array($__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f) || $__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f instanceof ArrayAccess ? ($__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f["gameplay"] ?? null) : null);
            echo "</div>
                </div>
            </div>
        </div>
    </div>
    ";
        }
        // line 71
        echo "</div>
<script type=\"text/javascript\">
    function goFullscreen(id) {
        var element = document.getElementById(id);
        var elementheader = document.getElementById(\"gameheader\");


        var userAgent = window.navigator.userAgent;


        if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {

            element.classList.add(\"fullscreen-safari\");
            elementheader.classList.add(\"displaynone\");

        } else {

            var isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
                (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
                (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
                (document.msFullscreenElement && document.msFullscreenElement !== null);

            var docElm = document.documentElement;
            if (!isInFullScreen) {
                element.classList.add(\"fullscreen\");
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullScreen) {
                    element.webkitRequestFullScreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }

            } else {
                element.classList.remove(\"fullscreen\");
                if (document.exitFullscreen) {
                    element.classList.remove(\"fullscreen\");
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }

        }
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "play.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 71,  133 => 65,  127 => 62,  106 => 43,  103 => 42,  99 => 40,  93 => 37,  89 => 35,  87 => 34,  82 => 32,  79 => 31,  77 => 30,  65 => 21,  60 => 19,  57 => 18,  55 => 17,  45 => 9,  40 => 6,  38 => 5,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout.twig\" %}

{% block content %}
<div class=\"content\">
    {% if (not cur_game['file']) %}
        <div class=\"alert alert-warning\">No game file has been added for this game. If you are an administrator you can edit this by the administration
            panel.</div>
    {% else %}
        <div class=\"game-bar\" id=\"gameheader\">
            <div class=\"pull-right\">
                <button onclick=\"goFullscreen('player'); return false\" style=\"background:none;border:none;color:white;\">
                    <i class=\"fa fa-arrows-alt\" aria-hidden=\"true\"></i> Fullscreen
                </button>
            </div>
        </div>
        <div class=\"w-100 mb-3\">            
            {% if (cur_game['type'] == \"Flash\") %}
                <object class=\"embed-responsive embed-responsive-16by9\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" id=\"myFlashContent\">
                    <param name=\"movie\" value=\"{{ cur_game['file'] }}\">
                    <!--[if !IE]>-->
                    <object type=\"application/x-shockwave-flash\" data=\"{{ cur_game['file'] }}\">
                        <!--<![endif]-->
                        <a href=\"http://www.adobe.com/go/getflashplayer\">
                            <img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\">
                        </a>
                        <!-- [if !IE]>-->
                    </object>
                    <!--<![endif]-->
                </object>
            {% elseif (cur_game['type'] == \"HTML5\") %}
                <div class=\"embed-responsive embed-responsive-16by9\">
                    {{ cur_game['file'] | raw }}
                </div>
            {% elseif (cur_game['type'] == \"HTML5-url\") %}
                <!-- 16:9 aspect ratio -->
                <div class=\"embed-responsive embed-responsive-16by9\">
                    <iframe class=\"embed-responsive\" width=\"100%\" src=\"{{ cur_game['file'] }}\"></iframe>
                </div>
            {% endif %}
        </div>
    {% endif %}
    {% if (cur_game['id']) %}
    <div class=\"card card-nav-tabs card-plain\">
        <div class=\"card-header card-header-danger\">
            <!-- colors: \"header-primary\", \"header-info\", \"header-success\", \"header-warning\", \"header-danger\" -->
            <div class=\"nav-tabs-navigation\">
                <div class=\"nav-tabs-wrapper\">
                    <ul class=\"nav nav-tabs\" data-tabs=\"tabs\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link active\" href=\"#description\" data-toggle=\"tab\">Description</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"#gameplay\" data-toggle=\"tab\">How to Play</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class=\"card-body \">
            <div class=\"tab-content text-center\">
                <div class=\"tab-pane active\" id=\"description\">
                    <div class=\"description-text\">{{ cur_game['description'] | raw }}</div>
                </div>
                <div class=\"tab-pane\" id=\"gameplay\">
                    <div class=\"description-text\">{{ cur_game['gameplay'] | raw }}</div>
                </div>
            </div>
        </div>
    </div>
    {% endif %}
</div>
<script type=\"text/javascript\">
    function goFullscreen(id) {
        var element = document.getElementById(id);
        var elementheader = document.getElementById(\"gameheader\");


        var userAgent = window.navigator.userAgent;


        if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {

            element.classList.add(\"fullscreen-safari\");
            elementheader.classList.add(\"displaynone\");

        } else {

            var isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
                (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
                (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
                (document.msFullscreenElement && document.msFullscreenElement !== null);

            var docElm = document.documentElement;
            if (!isInFullScreen) {
                element.classList.add(\"fullscreen\");
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullScreen) {
                    element.webkitRequestFullScreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }

            } else {
                element.classList.remove(\"fullscreen\");
                if (document.exitFullscreen) {
                    element.classList.remove(\"fullscreen\");
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }

        }
    }
</script>
{% endblock %}", "play.twig", "C:\\wamp64\\www\\slimar\\views\\play.twig");
    }
}
