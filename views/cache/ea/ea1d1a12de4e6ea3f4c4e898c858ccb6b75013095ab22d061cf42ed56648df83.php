<?php

/* payout.twig */
class __TwigTemplate_98a8fedec9a081ea422990fbffde0d7cdab35b7060ae334c8ec003795825a6c1 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("./layout/layout.twig", "payout.twig", 1);
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
        echo "    <div class=\"content\">
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <form class=\"form\" method=\"post\" id=\"login-nav\">
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"amount\">Amount</label>
                        <input type=\"number\" name=\"amount\" max=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["maximum"] ?? null), "html", null, true);
        echo "\" min=\"";
        echo twig_escape_filter($this->env, ($context["minimum"] ?? null), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "amount", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "amount", array())) : (($context["minimum"] ?? null))), "html", null, true);
        echo "\" id=\"amount\" class=\"form-control\" placeholder=\"Amount\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"bank\">Bank</label>
                        <select name=\"bank\" id=\"bank\" class=\"form-control\">
                            <option value=\"\">Select Bank</option>
                            ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["banks"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["bank"]) {
            // line 17
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["bank"], "id", array()), "html", null, true);
            echo "\" ";
            echo (((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "bank", array()) == twig_get_attribute($this->env, $this->source, $context["bank"], "id", array()))) ? ("selected") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["bank"], "name", array()), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bank'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "                        </select>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"account_number\">Account Number</label>
                        <input type=\"number\" name=\"account_number\" id=\"account_number\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "account_number", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "account_number", array())) : ("")), "html", null, true);
        echo "\" class=\"form-control\" placeholder=\"account Number\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"account_name\">Account Name</label>
                        <input type=\"text\" name=\"account_name\" value=\"";
        // line 27
        echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "account_name", array())) ? (twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "account_name", array())) : ("")), "html", null, true);
        echo "\" class=\"form-control\" placeholder=\"account name\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"type\">Account Type</label>
                        <select name=\"account_type\" id=\"account_type\" class=\"form-control\">
                            <option value=\"\">Select account type</option>
                            <option value=\"current\" ";
        // line 33
        echo (((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "account_type", array()) == "current")) ? ("selected") : (""));
        echo ">Current</option>
                            <option value=\"savings\" ";
        // line 34
        echo (((twig_get_attribute($this->env, $this->source, ($context["_post"] ?? null), "account_type", array()) == "savings")) ? ("selected") : (""));
        echo ">Savings</option>
                        </select>
                    </div>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"payout\" class=\"btn btn btn-block\" value=\"Submit\">
                    </div>
                </form>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "payout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 34,  95 => 33,  86 => 27,  79 => 23,  73 => 19,  60 => 17,  56 => 16,  43 => 10,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"./layout/layout.twig\" %}

{% block content %}
    <div class=\"content\">
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <form class=\"form\" method=\"post\" id=\"login-nav\">
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"amount\">Amount</label>
                        <input type=\"number\" name=\"amount\" max=\"{{maximum}}\" min=\"{{minimum}}\" value=\"{{ _post.amount ? _post.amount : minimum}}\" id=\"amount\" class=\"form-control\" placeholder=\"Amount\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"bank\">Bank</label>
                        <select name=\"bank\" id=\"bank\" class=\"form-control\">
                            <option value=\"\">Select Bank</option>
                            {% for bank in banks %}
                                <option value=\"{{ bank.id }}\" {{ _post.bank == bank.id ? 'selected' }}>{{ bank.name }}</option>
                            {% endfor %}
                        </select>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"account_number\">Account Number</label>
                        <input type=\"number\" name=\"account_number\" id=\"account_number\" value=\"{{_post.account_number ? _post.account_number}}\" class=\"form-control\" placeholder=\"account Number\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"account_name\">Account Name</label>
                        <input type=\"text\" name=\"account_name\" value=\"{{_post.account_name ? _post.account_name}}\" class=\"form-control\" placeholder=\"account name\" required=\"required\">
                    </div>
                    <div class=\"form-group\">
                        <label class=\"sr-only\" for=\"type\">Account Type</label>
                        <select name=\"account_type\" id=\"account_type\" class=\"form-control\">
                            <option value=\"\">Select account type</option>
                            <option value=\"current\" {{ _post.account_type == 'current' ? 'selected'}}>Current</option>
                            <option value=\"savings\" {{ _post.account_type == 'savings' ? 'selected'}}>Savings</option>
                        </select>
                    </div>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"payout\" class=\"btn btn btn-block\" value=\"Submit\">
                    </div>
                </form>
            </div>
        </div>
    </div>
{% endblock %}", "payout.twig", "C:\\wamp64\\www\\slimar\\views\\payout.twig");
    }
}
