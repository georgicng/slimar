<?php

/* stat.twig */
class __TwigTemplate_946bcb5482138b8482c441e27066a7b02e783ea407e64f58ea5f1491534680b4 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout.twig", "stat.twig", 1);
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

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "    <div class=\"row\">
        ";
        // line 4
        if ((twig_length_filter($this->env, ($context["played"] ?? null)) == 0)) {
            // line 5
            echo "            <div class=\"alert alert-warning\" role=\"alert\">No records found. Seems like you're yet to play a game</div>
        ";
        } else {
            // line 7
            echo "        <div class=\"col\">
            <table id=\"stat\" class=\"table table-striped table-bordered\" style=\"width:100%\">
                <thead>
                    <tr>
                        <th scope=\"col\">S/N</th>
                        <th scope=\"col\">Game</th>
                        <th scope=\"col\">Bet</th>
                        <th scope=\"col\">Win</th>                        
                    </tr>
                </thead>
                <tbody>
                    ";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["played"] ?? null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["ind"] => $context["record"]) {
                // line 19
                echo "                        <tr>
                            <th scope=\"row\">";
                // line 20
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "index", array()), "html", null, true);
                echo "</th>
                            <td>";
                // line 21
                echo twig_escape_filter($this->env, (($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = $context["record"]) && is_array($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5) || $__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 instanceof ArrayAccess ? ($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5["game"] ?? null) : null), "html", null, true);
                echo "</td>
                            <td>";
                // line 22
                echo twig_escape_filter($this->env, (($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = $context["record"]) && is_array($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a) || $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a instanceof ArrayAccess ? ($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a["bet"] ?? null) : null), "html", null, true);
                echo "</td>
                            <td>";
                // line 23
                echo twig_escape_filter($this->env, (($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 = $context["record"]) && is_array($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57) || $__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57 instanceof ArrayAccess ? ($__internal_b0b3d6199cdf4d15a08b3fb98fe017ecb01164300193d18d78027218d843fc57["win"] ?? null) : null), "html", null, true);
                echo "</td>
                        </tr>
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['ind'], $context['record'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "                </tbody>
            </table>
        </div>
        ";
        }
        // line 30
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "stat.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 30,  106 => 26,  89 => 23,  85 => 22,  81 => 21,  77 => 20,  74 => 19,  57 => 18,  44 => 7,  40 => 5,  38 => 4,  35 => 3,  32 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout.twig\" %}
{% block content %}
    <div class=\"row\">
        {% if (played | length == 0) %}
            <div class=\"alert alert-warning\" role=\"alert\">No records found. Seems like you're yet to play a game</div>
        {% else %}
        <div class=\"col\">
            <table id=\"stat\" class=\"table table-striped table-bordered\" style=\"width:100%\">
                <thead>
                    <tr>
                        <th scope=\"col\">S/N</th>
                        <th scope=\"col\">Game</th>
                        <th scope=\"col\">Bet</th>
                        <th scope=\"col\">Win</th>                        
                    </tr>
                </thead>
                <tbody>
                    {% for ind, record in played %}
                        <tr>
                            <th scope=\"row\">{{ loop.index }}</th>
                            <td>{{ record['game'] }}</td>
                            <td>{{ record['bet'] }}</td>
                            <td>{{ record['win'] }}</td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
        {% endif %}
    </div>
{% endblock %}", "stat.twig", "C:\\wamp64\\www\\slimar\\views\\stat.twig");
    }
}
