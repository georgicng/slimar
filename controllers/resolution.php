<?php
global $variables;
global $i;
global $in;

if (!$in['username']) {
    header("location: error.php?code=not_logged_in");
    exit;
}

use RedBeanPHP\Facade as R;
use Siler\Http\Request;

$user = R::load('users', $in['id']);
$review = Request\get(rv);
if (!empty($_SESSION['game_in_session'])) {
    unset($_SESSION['game_in_session']);
}

if ($user->locked) {
    if ($review && $user->inplay) {
        $game = R::load('games_plays', $user->inplay);
        $game->review = true;
        $user->inplay = 0;
        R::store($game);
    } else {
        $user->locked = false;
        $user->inplay = 0;
        R::store($user);
    }
    
}

if ($redirect = Request\get('r')) {
    if (strtolower(parse_url($redirect, PHP_URL_HOST)) == strtolower($_SERVER['HTTP_HOST'])) {
        header("location: ".$redirect);
        exit;
    }
    
}

header("location: games.php");