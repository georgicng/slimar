<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;
global $in;

if (!$in['id']) {
    header("location: index.php");
    exit;
}

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$plays = R::getAll(
    'select *, (select title from games where id = game_id)'.
    ' as game from games_plays where user_id = ? AND bet IS NOT NULL', 
    [$in['id']]
);
$data = array_merge(
    $variables,
    [
        'pagename' => "Your Winnings",
        'played' => $plays // R::find('games_plays', ' user_id = ?', $in['id']),
    ]
);

$shouldTwigDebug = true;
Twig\init('./views', './views/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('stat.twig', $data);
