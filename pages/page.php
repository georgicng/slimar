<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

//TODO: redirect to 404 page if id is not provided
$id = Request\get('p');

if (is_numeric($id)) {
    $page = R::load('pages', $id);
} else {
    $page = R::findOne('pages', ' slug = ?', [$id]);
}


$data = array_merge(
    $variables,
    [
        'pagename' => !empty($page)? $page['title'] : "Oops",
        'page' => !empty($page)? $page['content'] : false
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());

echo Twig\render('page.twig', $data);
