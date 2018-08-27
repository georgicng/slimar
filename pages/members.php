<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
//$variables = include SITE_ROOT.'/lib/variables.php';
global $variables;

use RedBeanPHP\Facade as R;
use Siler\Twig;
use Siler\Http\Request;
use Siler\Http\Response;

$u = R::find('users', ' ORDER BY usergroup DESC, id desc', []);
$users = [];
foreach ($u as $ind => $user) {
    //Gets user profile picture
    if (get_gravatar($user['email']) && $user['gravatar'] == "1") {
        $profilepic = get_gravatar($user['email']);
    } else {
        $profilepic = $user['profilepic'];
    }
    
    $in_perm2 = R::findOne('usergroups', ' rank = ?', [$user['usergroup']]);

    $users[] = [ 'bio' => $user, 'dp' => $profilepic, 'perm' => $in_perm2 ];
}
                    

$data = array_merge(
    $variables,
    [
        'pagename' => 'Members',
        'users' => $users,
    ]
);

$shouldTwigDebug = true;
Twig\init('./templates', './templates/cache', $shouldTwigDebug)
    ->addExtension(new Twig_Extension_Debug());
    
echo Twig\render('members.twig', $data);
