<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;

if ($search = Request\post('search-text')) {
    $searchvalue = filter_var($search, FILTER_SANITIZE_STRING);
    $games = R::find('games', ' status = 1 AND (title LIKE :text OR description LIKE :text) ORDER BY id DESC', [':text' => '%'.$searchvalue.'%']);
}


$data = array_merge(
    $variables,
    [
        'pagename' => "Search results for: ".$search,
        'games' => $games,
    ]
);

$shouldTwigDebug = true;
Twig\init('./views', './views/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('search.twig', $data);
