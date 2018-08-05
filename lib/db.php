<?php 
use RedBeanPHP\Facade as R;

R::setup("mysql:host=$hostname;dbname=$database", $username, $password);
