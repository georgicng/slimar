<?php
global $variables;

use Siler\Twig;
use Siler\Http\Request;

if ($code = Request\get('code')) {
    switch($code) {
        case 'game_in_session';
            $title = "Game in session";
            $message = "Oops, seems like you already have a game in session. You would need to end that game before you can continue";
            $action = '<a href="#" class="btn btn-lg btn-secondary">Force Play</a>';
            break;
        case 'not_logged_in';
            $title = "You are not logged in";
            $message = 'You need to be logged in to play this game. Please <a href="#">Log in</a> or <a href="#"> Create an account </a> to continue.';
            $action = '<a href="#" class="btn btn-lg btn-secondary">Go back</a>';
            break;
        default:
            $title = "Access Denied";
            $message = 'You need to be logged in to play this game. Please <a href="#">Log in</a> or <a href="#"> Create an account </a> to continue.';
            $action = '<a href="#" class="btn btn-lg btn-secondary">Go back</a>';
    }
}
$data = array_merge(
    $variables,
    [
        'pagename' => "Error",
        'title' => $title,
        'message' => $message,
        'action' => $action
    ]
);

$shouldTwigDebug = true;
$twig = Twig\init('./templates', './templates/cache', $shouldTwigDebug);
$twig->addExtension(new Twig_Extension_Debug());
//$twig->addExtension(new Umpirsky\Twig\Extension\PhpFunctionExtension());

echo Twig\render('error.twig', $data);