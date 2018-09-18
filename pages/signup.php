<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;
global $in;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

//Checks if user is logged in, if logged in redirects
if ($in['id']) {
    echo 'You are already signed in - Redirecting you back to home <meta http-equiv="refresh" content="3;url=index.php" />';
    exit;
}

$refer = Request\get('refer');

$data = array_merge(
    $variables,
    [
        'pagename' => 'signup',
        'refer' => $refer
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./templates', './templates/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());
$twig->addGlobal('_session', $_SESSION);
$twig->addGlobal('_post', $_POST);
$twig->addGlobal('_get', $_GET);
    
echo Twig\render('signup.twig', $data);
