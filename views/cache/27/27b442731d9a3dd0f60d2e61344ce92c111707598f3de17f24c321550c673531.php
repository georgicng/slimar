<?php

/* partials/footer.twig */
class __TwigTemplate_01cc3e40e025e15d3d591e8190c12c9a12b226e11b945c15cc370c14025060a5 extends Twig_Template
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
        echo "    <footer class=\"footer bg-primary text-light\">
        <div class=\"container d-flex flex-column flex-lg-row align-items-center justify-content-lg-between\">
            <nav class=\"mb-3\">
                ";
        // line 4
        echo twig_get_attribute($this->env, $this->source, ($context["footer_menu"] ?? null), "html", array(), "method");
        echo "
            </nav>
            <div class=\"copyright mb-3\" id=\"copyright\">
                &copy;
                <script>
                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>, ";
        // line 10
        echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = ($context["i"] ?? null)) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["title"] ?? null) : null), "html", null, true);
        echo " . All rights reserved
            </div>
        </div>
    </footer>
</div>

<!-- Core JS Files -->
<script src=\"assets/js/core/jquery.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/core/popper.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/core/bootstrap.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/now-ui-kit.js?v=1.2.0\" type=\"text/javascript\"></script>
<!-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src=\"assets/js/loadingoverlay.min.js\"></script>
<script src=\"assets/js/plugins/bootstrap-switch.js\"></script>
<!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src=\"assets/js/plugins/nouislider.min.js\" type=\"text/javascript\"></script>
<!-- Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src=\"assets/js/plugins/bootstrap-datepicker.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/hullabaloo.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/screenfull.min.js\" type=\"text/javascript\"></script>
<!--script type=\"text/javascript\" src=\"assets/js/bootstrap.offcanvas.min.js\"></script-->
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script type=\"text/javascript\" src=\"assets/js/script-loader.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "partials/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 10,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("    <footer class=\"footer bg-primary text-light\">
        <div class=\"container d-flex flex-column flex-lg-row align-items-center justify-content-lg-between\">
            <nav class=\"mb-3\">
                {{ footer_menu.html() | raw }}
            </nav>
            <div class=\"copyright mb-3\" id=\"copyright\">
                &copy;
                <script>
                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>, {{i['title']}} . All rights reserved
            </div>
        </div>
    </footer>
</div>

<!-- Core JS Files -->
<script src=\"assets/js/core/jquery.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/core/popper.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/core/bootstrap.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/now-ui-kit.js?v=1.2.0\" type=\"text/javascript\"></script>
<!-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src=\"assets/js/loadingoverlay.min.js\"></script>
<script src=\"assets/js/plugins/bootstrap-switch.js\"></script>
<!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src=\"assets/js/plugins/nouislider.min.js\" type=\"text/javascript\"></script>
<!-- Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src=\"assets/js/plugins/bootstrap-datepicker.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/hullabaloo.min.js\" type=\"text/javascript\"></script>
<script src=\"assets/js/screenfull.min.js\" type=\"text/javascript\"></script>
<!--script type=\"text/javascript\" src=\"assets/js/bootstrap.offcanvas.min.js\"></script-->
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script type=\"text/javascript\" src=\"assets/js/script-loader.js\"></script>
", "partials/footer.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\footer.twig");
    }
}
