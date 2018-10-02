<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;
global $in;

use RedBeanPHP\Facade as R;
use Siler\Http\Request;

//Checks if user is logged in, if logged in redirects
if ($id = Request\get('id')) {
    $user = R::findOne('users', ' verified_rand = ?', [$id]);
    if (!empty($user)) {
        $user->verified = true;
        R::store($user);
        header("location: login.php?verified=true");
    } else {
        header("location: login.php?verified=failed");
    }
}


