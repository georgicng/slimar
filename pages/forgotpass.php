<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$p = \Request\get('p');
if (empty($p)) {
    $page = "home";
} else {
    $page = $p;
}

$message = '';

if ($page == "reset") {
    $row = R::findOne('users', ' forgotid = ?', [ \Request\get('u') ]);
    if (empty($row)) {
        $message = '<div class="alert alert-danger" role="alert">Invalid reset code</div>';
    } else {
        if (!empty(\Request\post('changepassword'))) {
            $newpassword = "".\Request\post('password-new')."";
            $confirmpassword = "".\Request\post('password-new2')."";
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
    
            if ($newpassword == $confirmpassword) {
                $password_hashed = password_hash($newpassword, PASSWORD_DEFAULT);
                activitylog(''.$row['username'].'', 'updated their password', ''.time().'');
                $user->password = $password_hashed;
                R::store($row);
                setcookie("password", $password_hashed, time()+3600);
                $message =  '<div class="alert alert-success" role="alert">Password updated</div>';
            } else {
                $message =  '<div class="alert alert-danger" role="alert">Two passwords do not match</div>';
            }
        }
    }
}

if ($page == "home") {
    if (!empty(\Request\post('forgotpassword'))) {
        $row = R::findOne('users', ' forgotid = ?', [ \Request\post('forgot_email') ]);
        if ($empty($row)) {
            $message = '<div class="alert alert-danger" role="alert">The email you have entered does not exist</div>';
        } else {
            forgotpassword("".$row['username']."", "".$row['email']."", "".$i['email']."", "".$i['emailserver']."", "".$i['title']."", "lala");
            $message = '<div class="alert alert-success" role="alert">An email has been sent to '.$row['email'].'</div>';
            $step2 = "1";
        }
    }
}


$data = array_merge(
    $variables,
    [
        'pagename' => "home",
        'message' => $message,
        'page' => $page
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('forgotpass.twig', $data);
