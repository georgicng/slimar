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

if (!empty($_SESSION['game_in_session'])) {
    unset($_SESSION['game_in_session']);
}

$user = R::load('users', $in['id']);

if ($user->locked) {
    $review = Request\get('rv');
    if (!empty($review)) {
        $game = R::load('games_plays', $user->inplay);
        $game->review = true;
        R::store($game);
    } 
    $user->locked = false;
    $user->inplay = 0;
    R::store($user); 
}

if ($game = Request\get('g')) {
    header("location: play.php?g=".$game);
    exit;
}

header("location: games.php");