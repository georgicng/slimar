<?php 
use RedBeanPHP\Facade as R;
R::setup('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
R::debug(true, 1); //select mode 1 to suppress screen output

R::ext(
    'xdispense',
    function ($type) {
        return R::getRedBean()->dispense($type);
    }
);