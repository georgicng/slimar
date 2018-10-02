<?php

/* layout/mail_template.twig */
class __TwigTemplate_b0eb3094e04d2842c28d65d110ac9a23681d4a3810d48301dd5a752f4193a6ed extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'subject' => array($this, 'block_subject'),
            'body_html' => array($this, 'block_body_html'),
            'html_content' => array($this, 'block_html_content'),
            'body_text' => array($this, 'block_body_text'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('subject', $context, $blocks);
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('body_html', $context, $blocks);
        // line 203
        echo "
";
        // line 204
        $this->displayBlock('body_text', $context, $blocks);
    }

    // line 1
    public function block_subject($context, array $blocks = array())
    {
        echo " ";
    }

    // line 3
    public function block_body_html($context, array $blocks = array())
    {
        // line 4
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
        <meta name=\"viewport\" content=\"width=device-width\"/>

        <!-- For development, pass document through inliner -->
        <style type=\"text/css\">

            * {
                margin: 0;
                padding: 0;
                font-size: 100%;
                font-family: 'Avenir Next', \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;
                line-height: 1.65;
            }

            img {
                max-width: 100%;
                margin: 0 auto;
                display: block;
            }

            .body-wrap,
            body {
                width: 100% !important;
                height: 100%;
                background: #f8f8f8;
            }

            a {
                color: #71bc37;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .text-left {
                text-align: left;
            }

            .button {
                display: inline-block;
                color: white;
                background: #71bc37;
                border: solid #71bc37;
                border-width: 10px 20px 8px;
                font-weight: bold;
                border-radius: 4px;
            }

            .button:hover {
                text-decoration: none;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                margin-bottom: 20px;
                line-height: 1.25;
            }

            h1 {
                font-size: 32px;
            }

            h2 {
                font-size: 28px;
            }

            h3 {
                font-size: 24px;
            }

            h4 {
                font-size: 20px;
            }

            h5 {
                font-size: 16px;
            }

            ol,
            p,
            ul {
                font-size: 16px;
                font-weight: normal;
                margin-bottom: 20px;
            }

            .container {
                display: block !important;
                clear: both !important;
                margin: 0 auto !important;
                max-width: 580px !important;
            }

            .container table {
                width: 100% !important;
                border-collapse: collapse;
            }

            .container .masthead {
                padding: 80px 0;
                background: #71bc37;
                color: white;
            }

            .container .masthead h1 {
                margin: 0 auto !important;
                max-width: 90%;
                text-transform: uppercase;
            }

            .container .content {
                background: white;
                padding: 30px 35px;
            }

            .container .content.footer {
                background: none;
            }

            .container .content.footer p {
                margin-bottom: 0;
                color: #888;
                text-align: center;
                font-size: 14px;
            }

            .container .content.footer a {
                color: #888;
                text-decoration: none;
                font-weight: bold;
            }

            .container .content.footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <table class=\"body-wrap\">
            <tr>
                <td class=\"container\">

                    <!-- Message start -->
                    <table>
                        <tr>
                            <td align=\"center\" class=\"masthead\">

                                <h1>Chapgames...</h1>

                            </td>
                        </tr>
                        <tr>
                            <td class=\"content\">
                                ";
        // line 174
        $this->displayBlock('html_content', $context, $blocks);
        // line 175
        echo "                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td class=\"container\">

                    <!-- Message start -->
                    <table>
                        <tr>
                            <td class=\"content footer\" align=\"center\">
                                <p>Sent by
                                    <a href=\"#\">Chapgames Inc</a>, 1234 Lekki Expressway Way, Igbo-efon, Lagos</p>
                                <p>
                                    <a href=\"mailto:\">hello@chapgames.com</a>
                                </p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </body>
</html>
";
    }

    // line 174
    public function block_html_content($context, array $blocks = array())
    {
    }

    // line 204
    public function block_body_text($context, array $blocks = array())
    {
        // line 205
        echo "    This is the text body.
";
    }

    public function getTemplateName()
    {
        return "layout/mail_template.twig";
    }

    public function getDebugInfo()
    {
        return array (  263 => 205,  260 => 204,  255 => 174,  224 => 175,  222 => 174,  50 => 4,  47 => 3,  41 => 1,  37 => 204,  34 => 203,  32 => 3,  29 => 2,  27 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout/mail_template.twig", "C:\\wamp64\\www\\slimar\\views\\layout\\mail_template.twig");
    }
}
