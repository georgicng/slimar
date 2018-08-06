<?php 
use RedBeanPHP\Facade as R;

R::setup("mysql:host=$hostname;dbname=$database", $username, $password);

R::ext(
    'xdispense',
    function ($type) {
        return R::getRedBean()->dispense($type);
    }
);
