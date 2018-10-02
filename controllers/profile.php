<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$profile_username = $_GET['u'];

//Gathers information for users profile
$cur_user = R::findOne('users', ' username  = ?', [$profile_username]);

//Gathers users group ranking
$cur_user_perm = R::load('usergroups', cur_user['usergroup']);

//Gets user profile picture
if (get_gravatar($cur_user['email']) && $cur_user['gravatar'] == "1") {
    $profilepic2 = get_gravatar($cur_user['email']);
} else {
    $profilepic2 = $cur_user['profilepic'];
}

$post_count = R::count('games_comments', ' id_from = ?', [$cur_user['id']]);
$rating_count = R::count('games_rating', ' user_id = ?', [$cur_user['id']]);
                        
if (Request\get('page') == "") {
    $page = 1;
} else {
    $page = (int)Request\get('page');
}
                         
$rowsPerPage = 10;
$startLimit = ($page - 1) * $rowsPerPage;
                      
$nodes1 = R::find('users_comments', ' shown = `1`  && sub = `0` && id_to = ? ORDER BY ID DESC LIMIT ?, ?', [$cur_user['id'], $startLimit, $rowsPerPage]);

foreach ($nodes1 as $ind => $n1) {

    //Gathers commented users info
    $commentuser1 = R::load('users', $n1['id_from']);

    //Gathers commented users permissions
    $commentuser1_perm = R::find('usergroups', ' `rank` = ?', [$commentuser1['usergroup']]);

    //Gets user profile picture
    if (get_gravatar($commentuser1['email']) && $commentuser1['gravatar'] == "1") {
        $commentuser1_profilepic = get_gravatar($commentuser1['email']);
    } else {
        $commentuser1_profilepic = $commentuser1['profilepic'];
    }

    if (Request\post('deletecomment'.$n1['id'].'')) {
        $record = R::load('users_comments', $n1['id']);
        R::trash($record);
        $records = R::find('users_comments', ' sub_id = ?', [$n1['id']]);
        R::trash($records);
        header("location: profile.php?u=".$cur_user['username']."");
    }
    
    if (Request\post('editcomment'.$n1['id'].'')) {
        $record = R::load('users_comments', $n1['id']);
        $record->message = Request\post('message');
        R::store($record);
        header("location: profile.php?u=".$cur_user['username']."");
    }

    //replies
    $nodes2 = R::find('users_comments', ' shown = `1`  && sub_id = ? && sub = `1` ORDER BY ID ASC', [$n1['id']]);

    foreach ($nodes2 as $n2) {

        //Gathers commented users info
        $commentuser2 = R::load('users', $n2['id_from']);

        //Gathers commented users permissions
        $commentuser2_perm = R::find('usergroups', ' `rank` = ?', [$commentuser2['usergroup']]);

        //Gets user profile picture
        if (get_gravatar($commentuser2['email']) && $commentuser2['gravatar'] == "1") {
            $commentuser2_profilepic = get_gravatar($commentuser2['email']);
        } else {
            $commentuser2_profilepic = $commentuser2['profilepic'];
        }
    
        if ($_POST['deletecomment'.$n2["id"].'']) {
            $record = R::load('users_comments', $n2['id']);
            R::trash($record);
            header("location: profile.php?u=".$cur_user['username']."");
        }

        if ($_POST['editcomment'.$n2["id"].'']) {
            $record = R::load('users_comments', $n2['id']);
            $record->message = Request\post('message');
            R::store($record);
            header("location: profile.php?u=".$cur_user['username']."");
        }
    }
}

    
//pagination
$currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/profile.php?u=".$cur_user['username']."";

$count = R::count('users_comments', ' id_to = ?  && shown = `1`', [$cur_user['id']]);
            
$totalNumberOfPages = ceil($count / $rowsPerPage);

$lastpage = $page - 1;

$nextpage = $page + 1;

//favorites
$favourite_count = R::count('users_favourites', ' user_id = ?', [$cur_user['id']]);
$u1 = R::find('users_favourites', ' user_id = ? ORDER BY id desc', [$cur_user['id']]);

foreach ($u1 as $game1) {
    $u = R::load('games', $game1['game_id']);
}

$u2 = R::find('games_played', ' user_id = ? ORDER BY times_played desc LIMIT 20', [$cur_user['id']]);;

foreach ($u2 as $game2) {
    $u = R::load('games', $game2['game_id']);
}

$data = array_merge(
    $variables,
    [
        'pagename' => 'Profile',
        'users' => $users,
    ]
);

$shouldTwigDebug = true;
Twig\init('./views', './views/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('profile.twig', $data);
