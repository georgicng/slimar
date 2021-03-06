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

$data = array_merge(
    $variables,
    [
        'pagename' => "login",
        'verified' => !empty(Request\get('verified'))? Request\get('verified') : '',
        'created' => !empty(Request\get('created'))? Request\get('created') : '',
    ]
);

$shouldTwigDebug = true;
Twig\init('./views', './views/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('login.twig', $data);
