<?php
require_once SITE_ROOT.'/inc/config.php';
require_once SITE_ROOT.'/lib/db.php';

$variables = include SITE_ROOT.'/lib/variables.php';

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$id = Request\get('p');
$page = R::load('pages', $id);


$data = array_merge(
    $variables,
    [
        'pagename' => $page['title'],
        'page' => $page['content']
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());

echo Twig\render('page.twig', $data);
