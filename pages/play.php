<?php
require_once SITE_ROOT.'/inc/config.php';
require_once SITE_ROOT.'/lib/db.php';

$variables = include SITE_ROOT.'/lib/variables.php';

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$url = Request\get('g');
$cur_game = R::findOne('games', ' url = ?', [$url]);

//Whether to show this page or not
if ($i['direct_game'] == "1") {
    header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
}

if ($cur_game['id']) {
    $cur_game_category = R::findOne('games_categories', ' id = ?', [$cur_game['category_id']]);
}

if ($in['id']) {
    $user = R::load('users', $in['id']);
    $user->games_played = $user->games_played + 1;
    R::store($user);
    //Games played

    $gameplayed = R::count('games_played', ' game_id = ? && user_id = ?', [$cur_game['id'], $in['id']]);

    $gamesplayed2 = R::findOne('games_played', ' game_id = ? && user_id = ?', [$cur_game['id'], $in['id']]);
    
    if ($gameplayed == 1) {
        $gamesplayed2['times_played'] = $gamesplayed2['times_played'] + 1;
        $gamesplayed2['time'] = time();
        $gamesplayed2['month_played'] = date("F", strtotime("first day of this month"));
        R::store($gamesplayed2);
    } elseif ($gameplayed == 0) {
        $entry = R::xdispense('games_played');
        $stmt = $dbh->prepare("INSERT INTO games_played (user_id, game_id, time, month_played, times_played) VALUES (:user_id, :game_id, :time, :month, 1)");
        $entry->user_id = $in['id'];
        $entry->game_id = $cur_game['id'];
        $entry->time = time();
        $$entry->month = date("F", strtotime("first day of this month"));
        R::store($entry);
    }
}

if ($in['id']) {
    $positive = R::count('games_rating', ' game_id = ? && type = ?', [$cur_game['id'], 'pos']);
    $negative = R::count('games_rating', ' game_id = ? && type = ?', [$cur_game['id'], 'neg']);
    $rating = R::findOne('games_rating', ' game_id = ? && user_id = ?', [$cur_game['id'], $in['id']]);
    $total = $positive - $negative;
    $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
   
    if (!empty(Request\post('upvote'))) {
        if ($rating['rating_id']) {
            $rating->type = 'pos';
            R::store($rating);
        } else {
            $entry = R::dispense('games_rating ');
            $entry->game_id = $cur_game['id'];
            $entry->user_id = $in['id'];
            $entry->type = 'pos';
            R::store($entry);
        }
        header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
    }
    if (!empty(Request\post('downvote'))) {
        if ($rating['rating_id']) {
            $rating->type = 'neg';
            R::store($rating);
        } else {
            $entry = R::dispense('games_rating');
            $entry->game_id = $cur_game['id'];
            $entry->user_id = $in['id'];
            $entry->type = 'neg';
            R::store($entry);
        }
        header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
    }

    //favourites
    $fav = R::find('users_favourites', ' game_id = ? && user_id = ?', [$cur_game['id'], $in['id']]);
    
    if (!empty(Request\post('fav_add'))) {
        $entry = R::dispense('users_favourites');
        $entry->game_id = $cur_game['id'];
        $entry->user_id = $in['id'];
        R::store($entry);
        header("location: play.php?g=".$cur_game['url']."");
    }
    if (!empty(Request\post('fav_remove'))) {
        $record = R::findOne('users_favourites', ' game_id = ? && user_id = ?', [$cur_game['id'], $in['id']]);
        R::trash($record);
        header("location: play.php?g=".$cur_game['url']."");
    }
}
//Post comment
if (!empty(Request\post('postcommentprofile'))) {
    if ($in["username"]) {
        $id_from = $in['id'];
        $id_to = Request\post('userid');
        $message = strip_tags(Request\post('message'), '<br><b><strong>');
        $date = Request\post('date');
        $currenttime = time();

        if ($in['id'] != $id_from) {
            echo 'oh no theres an error!';
            activitylog(''.$in['username'].'', 'SECURITY ERROR: USER TRYING TO SEND COMMENT AS DIFFERENT USER', ''.time().'');
        } else {
            activitylog(''.$in['username'].'', 'commented on a profile', ''.time().'');
            $entry = R::dispense('games_comments');
            $entry->game_id = $cur_game['id'];
            $entry->id_from = $in['id'];
            $entry->message = $message;
            $entry->date = $currenttime;
        }
    }
}

//Post reply
if (!empty(Request\post('postreplyprofile'))) {
    if ($in["username"]) {
        $sub_id = $_POST['postid'];
        $id_from = $in['id'];
        $id_to = Request\post('userid');
        $message = strip_tags(Request\post('message'), '<br><b><strong>');
        $date = Request\post('date');
        $currenttime = time();
        $sub = "1";

        if ($in['id'] != $id_from) {
            echo 'oh no theres an error!';
            activitylog(''.$in['username'].'', 'SECURITY ERROR: USER TRYING TO SEND COMMENT AS DIFFERENT USER', ''.time().'');
        } else {
            activitylog(''.$in['username'].'', 'commented on a profile', ''.time().'');
            $entry = R::dispense('games_comments');
            $entry->game_id = $cur_game['id'];
            $entry->id_from = $in['id'];
            $entry->message = $message;
            $entry->sub = $sub;
            $entry->date = $currenttime;
        }
    }
}

if (Request\get('page') == "") {
    $page = 1;
} else {
    $page = (int)Request\get('page');
}
    
$rowsPerPage = 10;
$startLimit = ($page - 1) * $rowsPerPage;

$nodes2= R::find('games_comments', ' shown = `1`  && sub = `0` && game_id = ? ORDER BY ID DESC LIMIT ?, ?', [$cur_game['id'], $startLimit, $rowsPerPage]);

foreach ($nodes2 as $ind => $n1) {
    //Gathers commented users info
    $commentuser1 = R::load('users', $n1['id_from']);
    
    //Gathers commented users permissions
    $commentuser1_perm = R::find('usergroups', ' rank = ?', $commentuser1['usergroup']);
    
    //Gets user profile picture
    if (get_gravatar($commentuser1['email']) && $commentuser1['gravatar'] == "1") {
        $commentuser1_profilepic = get_gravatar($commentuser1['email']);
    } else {
        $commentuser1_profilepic = $commentuser1['profilepic'];
    }
}

if ($cur_user['username'] == $in["username"]
    || $commentuser1['username'] == $in["username"]
    || $in_perm['can_deletecomment'] == "1") {
    if (Request\post('deletecomment'.$n1['id'].'')) {
        $record = R::load('games_comments', $n1['id']);
        R::trash($record);
        $record = R::findOne('games_comments', 'sub_id = ?', [$n1['id']]);
        R::trash($record);
        header("location: play.php?g=".$cur_game['url']."");
    }
    
    if (Request\post('editcomment'.$n1['id'].'')) {
        $record = R::load('games_comments', $n1['id']);
        $record->message = $_POST['message'];
        R::store($record);
        header("location: play.php?g=".$cur_game['url']."");
    }
}

if ($cur_user['username'] == $in["username"]
    || $commentuser2['username'] == $in["username"]
    || $in_perm['can_deletecomment'] == "1") {
    $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/profile.php?u=".$cur_user['username']."";
}


    $count= R::count('games_comments', ' id_to = ? && shown = `1`', [$cur_user['id']]);
                
    $totalNumberOfPages = ceil($count / $rowsPerPage);

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

echo Twig\render('play.twig', $data);
