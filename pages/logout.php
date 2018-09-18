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

activitylog(''.$in['username'].'', 'Logged out', ''.time().'');
if ($in['username']) {
    setcookie("id", '', time() - 3600);
    setcookie("password", '', time() - 3600);
    header("location: index.php");
}

$data = array_merge(
    $variables,
    [
        'pagename' => "logout"
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('logout.twig', $data);
