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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Request\header('Content-Type') == 'json' ? Request\json() : Request\post();
    error_log('avatar '.json_encode($data));
    if ($data['action'] == 'avatar' && !empty($data['payload'])) {
        if (preg_match("/^data:image\/(?<extension>(?:png|gif|jpg|jpeg));base64,(?<image>.+)$/", $data['payload'], $matchings)) {
            $imageData = base64_decode($matchings['image']);
            $extension = $matchings['extension'];
            $filename = sprintf("%s/%s.%s", "./uploads", uniqid(), $extension);

            if (file_put_contents($filename, $imageData)) {
                activitylog(''.$in['username'].'', 'updated their avatar', ''.time().'');
                $user = R::load('users', $in['id']);
                $user->profilepic = $i['url'].'/'.$filename;
                R::store($user);
                $return['status'] = true;
                $return['message'] = "Profile updated";
                Response\json($return);
                exit;
            } 
        }
    }

    $return['status'] = false;
    $return['message'] = "Could not update profile";
    Response\json($return, 500);
    exit;
}

$plays = R::getAll('select *, (select title from games where id = game_id) as game from games_plays where user_id = ? AND bet IS NOT NULL', [$in['id']]);
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
