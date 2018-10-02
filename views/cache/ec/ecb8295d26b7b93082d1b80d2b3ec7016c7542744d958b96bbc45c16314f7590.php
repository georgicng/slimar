<?php

/* partials/alert_error.twig */
class __TwigTemplate_d24fa3366add3eacd6b2a36c74dfb96c223bba1984344cddbb300d98959cb428 extends Twig_Template
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
        if (twig_test_iterable(($context["error"] ?? null))) {
            // line 2
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["error"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["err"]) {
                // line 3
                echo "        <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
            <strong>ERROR:</strong> ";
                // line 4
                echo $context["err"];
                echo "
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['err'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 8
            echo "    <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
        <strong>ERROR:</strong> ";
            // line 9
            echo ($context["error"] ?? null);
            echo "
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "partials/alert_error.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 9,  43 => 8,  33 => 4,  30 => 3,  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if error is iterable %}
    {% for err in error %}
        <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
            <strong>ERROR:</strong> {{ err | raw }}
        </div>
    {% endfor %}
{% else %}
    <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">        
        <strong>ERROR:</strong> {{ error | raw }}
    </div>
{% endif %}", "partials/alert_error.twig", "C:\\wamp64\\www\\slimar\\views\\partials\\alert_error.twig");
    }
}
