<?php
//require_once SITE_ROOT.'/inc/config.php';
require "BootstrapMenu.php";
$str = '[{"text":"Home", "href": "#home", "title": "Home"}, {"text":"About", "href": "#", "title": "About", "children": [{"text":"Action", "href": "#action", "title": "Action"}, {"text":"Another action", "href": "#another", "title": "Another action"}]}, {"text":"Something else here", "href": "#something", "title": "Something else here"}]';
$qMenu = new BootstrapMenu(array('data'=>$str));
$qMenu->setActiveItem('http://codeignitertutoriales.com');
$qMenu->insert(array("text"=>'Ooh!', "href"=>'http://codeignitertutoriales.com', "title"=>'Awesome'), 'Another action', 'About');
$qMenu->insert(array("text"=>'Ultimo item', "href"=>'https://github.com/davicotico', "title"=>'My Github'));
$qMenu->replace(array('text'=>'About Wow', 'href'=>'about', 'title'=>'Hey'), 'Home');
$menu = $qMenu->html(); ?>

return [
    'categories' => include __DIR__.'/data/categories.php',
    'notifications' => include __DIR__.'/data/notifications.php',
    'i' => $i,
    'in' => $in,
    'in_perm' => $in_perm,
    'error' => $error,
    'success' => $success,
    'profilepic' =>  $profilepic,
    'currenturl' => $currenturl,
    'menu' => $menu
];
