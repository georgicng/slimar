<?php
define('SITE_ROOT', __DIR__);
require SITE_ROOT . '/vendor/autoload.php';

use Siler\Route;

Route\route(['get', 'post'], '/', 'pages/index.php');
Route\route(['get', 'post'], '/index.php', 'pages/index.php');
Route\route(['get', 'post'], '/cat.php', 'pages/cat.php');
Route\route(['get', 'post'], '/games.php', 'pages/games.php');
Route\route(['get', 'post'], '/game.php', 'pages/game.php');
Route\route(['get', 'post'], '/play.php', 'pages/play.php');
Route\route(['get', 'post'], '/search.php', 'pages/search.php');
Route\route(['get', 'post'], '/login.php', 'pages/login.php');
Route\route(['get', 'post'], '/signup.php', 'pages/signup.php');
Route\route(['get', 'post'], '/logout.php', 'pages/logout.php');
Route\route(['get', 'post'], '/fogotpass.php', 'pages/forgotpass.php');
Route\route(['get', 'post'], '/members.php', 'pages/members.php');
Route\route(['get', 'post'], '/profile.php', 'pages/profile.php');
Route\route(['get', 'post'], '/account_settings.php', 'pages/account_settings.php');
Route\route(['get', 'post'], '/page.php', 'pages/page.php');