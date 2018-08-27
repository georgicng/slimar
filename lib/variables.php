<?php
//require_once SITE_ROOT.'/inc/config.php';
//require_once SITE_ROOT.'/lib/db.php';
require "BootstrapMenu.php";

use RedBeanPHP\Facade as R;
global $i;
global $in;

//error_log("i: ".json_encode($i));
//error_log("in: ".json_encode($in));


$menu = R::findOne('menus', ' position = ?', ['main']);
//error_log('header menu: '.json_encode($menu));
$header_menu = new BootstrapMenu(
    array(
        'data'=>html_entity_decode(html_entity_decode($menu['content']))
    )
);
$menu = R::findOne('menus', ' position = ?', ['footer']);
//error_log('footer menu: '.json_encode($menu));
$footer_menu =  new BootstrapMenu(
    array(
        'data'=>html_entity_decode($menu['content'])
    )
);

return [
    'notifications' => R::find('site_notifications', ' enabled = ? ORDER BY id', [ 1 ]),
    'i' => $i,
    'in' => isset($in)? $in : null,
    'in_perm' => isset($in_perm)? $in_perm : null,
    'error' => isset($error)? $error : null,
    'success' =>isset($success)? $success : null,
    'profilepic' =>  isset($profilepic)? $profilepic : null,
    'currenturl' => isset($currenturl)? $currenturl : null,
    'header_menu' => $header_menu,
    'footer_menu' => $footer_menu
];
