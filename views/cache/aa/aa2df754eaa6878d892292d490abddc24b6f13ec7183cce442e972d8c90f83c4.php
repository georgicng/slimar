<?php

/* mail/registration.twig */
class __TwigTemplate_db92089e9cc4ae42ee164f0bb3e757f795429975f04f91a6bfd71939cd046c59 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("layout/mail_template.twig", "mail/registration.twig", 1);
        $this->blocks = array(
            'subject' => array($this, 'block_subject'),
            'body_html' => array($this, 'block_body_html'),
            'html_content' => array($this, 'block_html_content'),
            'body_text' => array($this, 'block_body_text'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout/mail_template.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_subject($context, array $blocks = array())
    {
        echo " ";
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo " - Chapgames ";
    }

    // line 5
    public function block_body_html($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayBlock('html_content', $context, $blocks);
        // line 24
        echo "    ";
        $this->displayParentBlock("body_html", $context, $blocks);
        echo "
";
    }

    // line 6
    public function block_html_content($context, array $blocks = array())
    {
        // line 7
        echo "    <h2>Hello ";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo ",</h2>

    <p>Your account has been created with the following details:</p>
    <table>
        <tr>
            <td>Log in email:</td>
            <td>";
        // line 13
        echo twig_escape_filter($this->env, ($context["email"] ?? null), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>Display Name: </td>
            <td>";
        // line 17
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</td>
        </tr>
    </table>
    <p>Click the link below to verify this email address.</p>

    <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["link"] ?? null), "html", null, true);
        echo "\">VERIFY EMAIL ADDRESS</a>
    ";
    }

    // line 27
    public function block_body_text($context, array $blocks = array())
    {
        // line 28
        echo "    Hello ";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "

    Your account has been created with the following details:
    Log in email: ";
        // line 31
        echo twig_escape_filter($this->env, ($context["email"] ?? null), "html", null, true);
        echo "
    Display Name: ";
        // line 32
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "

    Copy the link below into your browser to verify your email address:
    ";
        // line 35
        echo twig_escape_filter($this->env, ($context["link"] ?? null), "html", null, true);
        echo "

    Regards
";
    }

    public function getTemplateName()
    {
        return "mail/registration.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 35,  104 => 32,  100 => 31,  93 => 28,  90 => 27,  84 => 22,  76 => 17,  69 => 13,  59 => 7,  56 => 6,  49 => 24,  46 => 6,  43 => 5,  35 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "mail/registration.twig", "C:\\wamp64\\www\\slimar\\views\\mail\\registration.twig");
    }
}
