<?php
define('SITE_ROOT', __DIR__);
require SITE_ROOT . '/vendor/autoload.php';

use Siler\Route;

Route\get('/', 'pages/index.php');
Route\get('/index.php', 'pages/index.php');
Route\get('/cat.php', 'pages/cat.php');
Route\get('/games.php', 'pages/games.php');
Route\get('/game.php', 'pages/game.php');
