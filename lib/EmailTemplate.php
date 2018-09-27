<?php
class EMailTemplate
{
    protected $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getMessage($identifier, $parameters = array())
    {
        $template = $this->twig->loadTemplate('./templates/mail/'.$identifier.'.twig'); // Define your own schema

        $subject  = $template->renderBlock('subject',   $parameters);
        $bodyHtml = $template->renderBlock('html_body', $parameters);
        $bodyText = $template->renderBlock('text_body', $parameters);

        $mail = new PHPMailer;
        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $bodyHtml;
        $mail->AltBody = $bodyText;
        return $mail;
    }
}