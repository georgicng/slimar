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
        $this->parent = $this->loadTemplate("./layout/layout_no_header.twig", "play.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "./layout/layout_no_header.twig";
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
            panel.
        </div>
    ";
        } else {
            // line 10
            echo "        <div id=\"player\" style=\"position:relative\">
            <div class=\"game-bar d-flex justify-content-between\" id=\"gameheader\">
                <div class=\"btn-sm btn-secondary font-weight-bold\">
                        <span class=\"currency symbol\">N </span><span id=\"bar-user-balance\" class=\"balance money\">";
            // line 13
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = ($context["in"] ?? null)) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["balance"] ?? null) : null), 2, ".", ","), "html", null, true);
            echo "</span>
                        <span class=\"caret\"></span>
                </div>
                <div class=\"action\">
                    <button onclick=\"goFullscreen('player'); return false\" class=\"btn-sm btn-danger\">
                        <i class=\"fa fa-arrows-alt\" aria-hidden=\"true\"></i> Fullscreen
                    </button>
                </div>
            </div>
            <div class=\"w-100 mb-3\">            
                ";
            // line 23
            if (((($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = ($context["cur_game"] ?? null)) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["type"] ?? null) : null) == "Flash")) {
                // line 24
                echo "                    <object class=\"embed-responsive embed-responsive-16by9\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" id=\"myFlashContent\">
                        <param name=\"movie\" value=\"";
                // line 25
                echo twig_escape_filter($this->env, (($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 = ($context["cur_game"] ?? null)) && is_array($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9) || $__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9 instanceof ArrayAccess ? ($__internal_81ccf322d0988ca0aa9ae9943d772c435c5ff01fb50b956278e245e40ae66ab9["file"] ?? null) : null), "html", null, true);
                echo "\">
                        <!--[if !IE]>-->
                        <object type=\"application/x-shockwave-flash\" data=\"";
                // line 27
                echo twig_escape_filter($this->env, (($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 = ($context["cur_game"] ?? null)) && is_array($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217) || $__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217 instanceof ArrayAccess ? ($__internal_add9db1f328aaed12ef1a33890510da978cc9cf3e50f6769d368473a9c90c217["file"] ?? null) : null), "html", null, true);
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
            } elseif (((($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 =             // line 36
($context["cur_game"] ?? null)) && is_array($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105) || $__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105 instanceof ArrayAccess ? ($__internal_128c19eb75d89ae9acc1294da2e091b433005202cb9b9351ea0c5dd5f69ee105["type"] ?? null) : null) == "HTML5")) {
                // line 37
                echo "                    <div class=\"embed-responsive embed-responsive-16by9\">
                        ";
                // line 38
                echo (($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 = ($context["cur_game"] ?? null)) && is_array($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779) || $__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779 instanceof ArrayAccess ? ($__internal_921de08f973aabd87ecb31654784e2efda7404f12bd27e8e56991608c76e7779["file"] ?? null) : null);
                echo "
                    </div>
                ";
            } elseif (((($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 =             // line 40
($context["cur_game"] ?? null)) && is_array($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1) || $__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1 instanceof ArrayAccess ? ($__internal_3e040fa9f9bcf48a8b054d0953f4fffdaf331dc44bc1d96f1bb45abb085e61d1["type"] ?? null) : null) == "HTML5-url")) {
                // line 41
                echo "                    <!-- 16:9 aspect ratio -->
                    <div class=\"embed-responsive embed-responsive-16by9\">
                        <iframe class=\"embed-responsive\" width=\"100%\" src=\"";
                // line 43
                echo twig_escape_filter($this->env, (($__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0 = ($context["cur_game"] ?? null)) && is_array($__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0) || $__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0 instanceof ArrayAccess ? ($__internal_bd1cf16c37e30917ff4f54b7320429bcc2bb63615cd8a735bfe06a3f1b5c82a0["file"] ?? null) : null), "html", null, true);
                echo "\"></iframe>
                    </div>
                ";
            }
            // line 46
            echo "            </div>
        </div>
    ";
        }
        // line 49
        echo "    ";
        if ((($__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866 = ($context["cur_game"] ?? null)) && is_array($__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866) || $__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866 instanceof ArrayAccess ? ($__internal_602f93ae9072ac758dc9cd47ca50516bbc1210f73d2a40b01287f102c3c40866["id"] ?? null) : null)) {
            // line 50
            echo "    <div class=\"my-5\">        
        <ul class=\"nav nav-tabs nav-tabs-neutral\" data-tabs=\"tabs\" role=\"tablist\" data-background-color=\"blue\">
            <li class=\"nav-item\">
                <a class=\"nav-link active\" href=\"#description\" data-toggle=\"tab\"  role=\"tab\">Description</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#gameplay\" data-toggle=\"tab\"  role=\"tab\">How to Play</a>
            </li>
        </ul>
        <div class=\"tab-content\">
            <div class=\"tab-pane active my-3\" id=\"description\" role=\"tabpanel\">
                <div class=\"description-text\">";
            // line 61
            echo (($__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f = ($context["cur_game"] ?? null)) && is_array($__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f) || $__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f instanceof ArrayAccess ? ($__internal_de222b1ef20cf829a938a4545cbb79f4996337944397dd43b1919bce7726ae2f["description"] ?? null) : null);
            echo "</div>
            </div>
            <div class=\"tab-pane my-3\" id=\"gameplay\" role=\"tabpanel\">
                <div class=\"description-text\">";
            // line 64
            echo (($__internal_517751e212021442e58cf8c5cde586337a42455f06659ad64a123ef99fab52e7 = ($context["cur_game"] ?? null)) && is_array($__internal_517751e212021442e58cf8c5cde586337a42455f06659ad64a123ef99fab52e7) || $__internal_517751e212021442e58cf8c5cde586337a42455f06659ad64a123ef99fab52e7 instanceof ArrayAccess ? ($__internal_517751e212021442e58cf8c5cde586337a42455f06659ad64a123ef99fab52e7["gameplay"] ?? null) : null);
            echo "</div>
            </div>
        </div>
    </div>
    ";
        }
        // line 69
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
                screen.orientation.lock(\"landscape-primary\");
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
                //screen.orientation.lock(\"natural\");
                screen.orientation.unlock();
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
        return array (  143 => 69,  135 => 64,  129 => 61,  116 => 50,  113 => 49,  108 => 46,  102 => 43,  98 => 41,  96 => 40,  91 => 38,  88 => 37,  86 => 36,  74 => 27,  69 => 25,  66 => 24,  64 => 23,  51 => 13,  46 => 10,  40 => 6,  38 => 5,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout_no_header.twig\" %}

{% block content %}
<div class=\"content\">
    {% if (not cur_game['file']) %}
        <div class=\"alert alert-warning\">No game file has been added for this game. If you are an administrator you can edit this by the administration
            panel.
        </div>
    {% else %}
        <div id=\"player\" style=\"position:relative\">
            <div class=\"game-bar d-flex justify-content-between\" id=\"gameheader\">
                <div class=\"btn-sm btn-secondary font-weight-bold\">
                        <span class=\"currency symbol\">N </span><span id=\"bar-user-balance\" class=\"balance money\">{{in['balance']|number_format(2, '.', ',')}}</span>
                        <span class=\"caret\"></span>
                </div>
                <div class=\"action\">
                    <button onclick=\"goFullscreen('player'); return false\" class=\"btn-sm btn-danger\">
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
        </div>
    {% endif %}
    {% if (cur_game['id']) %}
    <div class=\"my-5\">        
        <ul class=\"nav nav-tabs nav-tabs-neutral\" data-tabs=\"tabs\" role=\"tablist\" data-background-color=\"blue\">
            <li class=\"nav-item\">
                <a class=\"nav-link active\" href=\"#description\" data-toggle=\"tab\"  role=\"tab\">Description</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#gameplay\" data-toggle=\"tab\"  role=\"tab\">How to Play</a>
            </li>
        </ul>
        <div class=\"tab-content\">
            <div class=\"tab-pane active my-3\" id=\"description\" role=\"tabpanel\">
                <div class=\"description-text\">{{ cur_game['description'] | raw }}</div>
            </div>
            <div class=\"tab-pane my-3\" id=\"gameplay\" role=\"tabpanel\">
                <div class=\"description-text\">{{ cur_game['gameplay'] | raw }}</div>
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
                screen.orientation.lock(\"landscape-primary\");
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
                //screen.orientation.lock(\"natural\");
                screen.orientation.unlock();
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
