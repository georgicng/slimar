<?php
//require_once SITE_ROOT.'/inc/config.php';
require "BootstrapMenu.php";

use RedBeanPHP\Facade as R;

$str = '[{"text":"Home", "href": "#home", "title": "Home"}, {"text":"About", "href": "#", "title": "About", "children": [{"text":"Action", "href": "#action", "title": "Action"}, {"text":"Another action", "href": "#another", "title": "Another action"}]}, {"text":"Something else here", "href": "#something", "title": "Something else here"}]';

$menu = R::findOne('menus', ' position = ?', ['main']);
//error_log('menu: '.html_entity_decode($menu['content']));
$header_menu = new BootstrapMenu(
    array(
        'data'=>html_entity_decode(html_entity_decode($menu['content']))
    )
);
$menu = R::findOne('menus', ' position = ?', ['footer']);
//error_log('menu 2: '.json_encode($menu));
$footer_menu =  new BootstrapMenu(
    array(
        'data'=>html_entity_decode($menu['content'])
    )
);

return [
    'categories' => include __DIR__.'/data/categories.php',
    'notifications' => include __DIR__.'/data/notifications.php',
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
