<?php
//require_once SITE_ROOT.'/inc/config.php';

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
];
