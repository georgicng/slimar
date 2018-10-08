<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EMailTemplate
{
    protected $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getMessage($identifier, $parameters = array())
    {
        $template = $this->twig->loadTemplate('mail/'.$identifier.'.twig'); // Define your own schema

        $subject  = $template->renderBlock('subject',   $parameters);
        $bodyHtml = $template->renderBlock('body_html', $parameters);
        $bodyText = $template->renderBlock('body_text', $parameters);
        
        $mail = new PHPMailer;
        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $bodyHtml;
        $mail->AltBody = $bodyText;
        return $mail;
    }
}