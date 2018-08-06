<?php
define('SITE_ROOT', __DIR__);
require SITE_ROOT . '/vendor/autoload.php';

use Siler\Route;

Route\get('/', 'pages/index.php');
Route\get('/index.php', 'pages/index.php');
Route\get('/cat.php', 'pages/cat.php');
Route\get('/games.php', 'pages/games.php');
Route\get('/game.php', 'pages/game.php');
Route\get('/play.php', 'pages/play.php');
Route\get('/search.php', 'pages/search.php');
Route\get('/login.php', 'pages/login.php');
Route\get('/signup.php', 'pages/signup.php');
Route\get('/logout.php', 'pages/logout.php');
Route\get('/fogotpass.php', 'pages/forgotpass.php');
Route\get('/members.php', 'pages/members.php');
Route\get('/profile.php', 'pages/profile.php');
Route\get('/account_settings.php', 'pages/account_settings.php');
Route\get('/page.php', 'pages/page.php');