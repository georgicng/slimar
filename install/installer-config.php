<?php


$setting = Array(	
	'config'		=>	Array (
		'folder'	=>	'../inc/',
		'file'		=>	'details.php'
		),
	'database'		=>	Array (		
		'name'		=> 'DB_NAME',
		'user'		=> 'DB_USER',
		'pass'		=> 'DB_PASS',
		'host'		=> 'DB_HOST'
		),
	'requirements'	=>	Array (
		'php'		=>	'5.2'
		),
	'name'			=>	'SlimarGame',
	'finished'		=>	'Get started!',
	'after_install'	=>	'../index.php'
	);

function connect() {
	$hostname = DB_HOST;
	$username = DB_USER;
	$password = DB_PASS;
	$database = DB_NAME;


	try { 
		$dbh = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
		}
	catch(PDOException $e) //if can't grab database information show error page
		{
		echo $username, $password, '<h2>This website can not connect to the database</h2><br><a href="?step=1" class="button" style="float:left"> <span>&lsaquo; Re-install</span> </a><br>';
		exit;
		}
		
		
	$link = mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME,$link);
}

?>