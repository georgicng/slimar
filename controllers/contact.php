<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$data = array_merge(
    $variables,
    [
        'pagename' => "Contact Us"
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./views', './views/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());
$twig->addGlobal('_session', $_SESSION);
$twig->addGlobal('_post', $_POST);
$twig->addGlobal('_get', $_GET);

echo Twig\render('contact.twig', $data);
