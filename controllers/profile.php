<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;
global $i;
global $in;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

if (!$in['username']) {
    header("location: error.php?code=not_logged_in");
    exit;
}

$plays = R::getAll('select *, (select title from games where id = game_id) as game from games_plays where user_id = ?', [$in['id']]);
$payments =  R::find('payments', ' userid = ? and verified = 1', [$in['id']]);
$won = R::getCell('SELECT SUM(win) FROM games_plays WHERE user_id = ?', [$in['id']]);
$data = array_merge(
    $variables,
    [
        'pagename' => 'Profile',
        'user' => $in,
        'played' => $plays,
        'payments' => $payments,
        'won' => $won ? $won : 0
    ]
);

$shouldTwigDebug = true;
Twig\init('./views', './views/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('profile.twig', $data);
