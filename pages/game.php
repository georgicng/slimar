<?php
require_once SITE_ROOT.'/inc/config.php';
require_once SITE_ROOT.'/lib/db.php';

$variables = include SITE_ROOT.'/lib/variables.php';

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

if (!empty(Request\post('fav_add'))) {
    $entry = R::dispense('users_favourites');
    $entry->game_id = $cur_game['id'];
    $entry->user_id = $$in['id'];
    R::store($entry);
    header("location: ".$currenturl."/game.php?g=".$cur_game['url']."");
}

    
if (!empty(Request\post('fav_remove'))) {
    $fav = R::findOne('users_favourites', ' game_id = ? && user_id = ?', [$cur_game['id'], $in['id']]);
    R::trash($fav);
    header("location: ".$currenturl."/game.php?g=".$cur_game['url']."");
}

$url = Request\get('g');
$cur_game = R::findOne('games', ' url = ?', [$url]);

//Whether to show this page or not
if ($i['direct_game'] == "1") {
    header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
}

if ($cur_game['id']) {
    $cur_game_category = R::findOne('games_categories', ' id = ?', [$cur_game['category_id']]);
}

$fav = R::find('users_favourites', ' game_id = ? && user_id = ?', [$cur_game['id'], $in['id']]);
$positive = R::count('games_rating', ' game_id = ? && type = ?', [$cur_game['id'], 'pos']);
$negative = R::count('games_rating', ' game_id = ? && type = ?', [$cur_game['id'], 'neg']);

$data = array_merge(
    $variables,
    [
        'pagename' => "Game",
        'fav' => $fav,
        'rating' => $positive - $negative,
        'date' => date('M d, Y', $cur_game['date']),
        'cur_game' => $cur_game,
        'cur_game_category' => $cur_game_category
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());

echo Twig\render('game.twig', $data);
