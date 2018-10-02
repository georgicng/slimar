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

if ($in['locked'] || !empty($_SESSION['game_in_session'])) {
    header("location: error.php?code=game_in_session");
    exit;
}

$url = Request\get('g');
$cur_game = R::findOne('games', ' url = ?', [$url]);


if ($cur_game['id']) {
    $cur_game_category = R::findOne('games_categories', ' id = ?', [$cur_game['category_id']]);
}

$data = array_merge(
    $variables,
    [
        'pagename' => "Game",
        'cur_game' => $cur_game,
        'cur_game_category' => $cur_game_category ? $cur_game_category : ''
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./views', './views/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());
$twig->addGlobal('_session', $_SESSION);
$twig->addGlobal('_post', $_POST);
$twig->addGlobal('_get', $_GET);

echo Twig\render('play.twig', $data);
