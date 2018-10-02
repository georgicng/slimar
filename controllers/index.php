<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$primary = null;
$query = ' status = ?';

switch (Request\get('s')) {
    case "rated":
        $primary = "rated";
        $query .= ' ORDER BY current_votes DESC LIMIT 30';
        break;
    case "popular":
        $primary= "popular";
        $query .= ' ORDER BY view_count DESC LIMIT 30';
        break;
    case "random":
        $primary= "random";
        $query = ' ORDER BY rand() LIMIT 30';
        break;
    default:
        $primary= "latest";
        $query .= ' ORDER BY id DESC LIMIT 30';
}

$data = array_merge(
    $variables,
    [
        'pagename' => "Home",
        'games' => R::find('games', $query, [1]),
        'sort' => !empty(Request\get('s'))? Request\get('s') : '',
        'primary' => $primary
    ]
);

$shouldTwigDebug = true;
Twig\init('./views', './views/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());

echo Twig\render('index.twig', $data);
