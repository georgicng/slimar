<?php
global $variables;
global $i;
global $in;
//TODO: on network error save in localstorage/cookie and send that to server on next play to process
if (!$in['username']) {
    header("location: error.php?code=not_logged_in");
    exit;
}

use RedBeanPHP\Facade as R;
use Siler\Http\Request;
use Siler\Http\Response;

$data = Request\json();
$user = R::load('users', $in['id']);
if (!empty($_SESSION['game_in_session'])) {
    $game = $_SESSION['game_in_session'];
}
$return = [];
error_log('session: '.json_encode($_SESSION));
error_log('data: '.json_encode($data));
if ($data['game'] == 1) {
    switch($data['type']){
        case 'start_session':
            if (!empty($_SESSION['game_in_session'])) {
                $return['redirect'] = true;
                $return['url'] = $i['url']."/error.php?code=game_in_session";
                Response\json($return);
                exit;
            }
            
            $user->locked = true;
            R::store($user);
            break;
        case 'end_session':
            $user->locked = false;
            R::store($user);
            break;
        case 'bet_placed':
            $entry = R::xdispense('games_plays');
            $entry->user_id = $in['id'];
            $entry->game_id = $data['game'];
            $entry->start = $data['event']['timeStamp'];
            $entry->bet = $data['bet'];
            R::store($entry);            
            $_SESSION['game_in_session'] = $entry->id;
            $in['balance'] -= $data['bet'];
            $user->balance = $in['balance'];
            R::store($user);
            $return['id'] = $entry->id;
            break;
        case 'save_score':
            $entry = R::load('games_plays', $game);
            $entry->end = $data['event']['timeStamp'];
            $entry->win = floatval($data['score']) - floatval($in['balance']);
            R::store($entry);
            $in['balance'] = $data['score'];
            $user->balance = $in['balance'];
            R::store($user);
            unset($_SESSION['game_in_session']);
            break;
        case 'share_score':
            $in['balance'] = $data['score'];
            $user->balance = $in['balance'];
            R::store($user);
            break;
    }
}

if ($data['game'] == 2) {
    switch($data['type']){
        case 'start_session':
            if (!empty($_SESSION['game_in_session'])) {
                $return['redirect'] = true;
                $return['url'] = $i['url']."/error.php?code=game_in_session";
                Response\json($return);
                exit;
            }
            $entry = R::xdispense('games_plays');
            $entry->user_id = $in['id'];
            $entry->game_id = $data['game'];
            $entry->start = $data['event']['timeStamp'];
            R::store($entry);
            $user->locked = true;
            R::store($user);
            $_SESSION['game_in_session'] = $entry->id;
            $return['id'] = $entry->id;
            break;
        case 'end_session':
            $entry = R::load('games_plays', $game);
            $entry->end = $data['event']['timeStamp'];
            $entry->game_id = $data['game'];
            R::store($entry);
            $user->locked = false;
            R::store($user);
            unset($_SESSION['game_in_session']);
            break;
        case 'bet_placed':
            $entry = R::load('games_plays', $game);
            $entry->bet = $data['bet'];
            R::store($entry);
            $in['balance'] -= $data['bet'];
            $user->balance = $in['balance'];
            R::store($user);
            break;
        case 'save_score':
            $entry = R::load('games_plays', $game);
            $entry->end = $data['event']['timeStamp'];
            $entry->win = floatval($data['score']) - floatval($in['balance']);
            R::store($entry);
            $in['balance'] = $data['score'];
            $user->balance = $in['balance'];
            R::store($user);
            unset($_SESSION['game_in_session']);
            break;
        case 'share_score':
            $in['balance'] = $data['score'];
            $user->balance = $in['balance'];
            R::store($user);
            break;
    }
}


$return['balance'] = $in['balance'];

Response\json($return);