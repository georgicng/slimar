<?php
if (isset($_GET['step']))
$step = $_GET['step'];
else
$step = 0;

require_once('installer-config.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title><?php echo $setting['name'] ?> Installation</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link href="installer-styles.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="files/css/global.css">
<link href="files/css/main.css" rel="stylesheet" />
<link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.1.1.min.js" defer></script>
<script src="https://vsn4ik.github.io/bootstrap-checkbox/dist/js/bootstrap-checkbox.js" defer></script></head>


 </head>
 <body>



  <div id="container">
  <div id="main" style="background:#34495e;color:white;padding:10px;font-size:15pt;">SlimarGame - Installation</div>
	<div id="main">
	<div class="pad25">
<?php

// Requirements check
if (!isset($_GET['step'])) {
	if (!is_writable($setting['config']['folder']))
		$msg .= '<br><p>WARNING! I can not write to the <code>'.$setting['config']['folder'].'</code> directory or does not exist. You will have to either change the permissions on your installation directory or create this folder manually.</p><br>';
	if (phpversion() < $setting['requirements']['php'])
		$msg .= '<br><p>WARNING! The minimum PHP version is <code>'.$setting['requirements']['php'].'</code>, your version is <code>'.phpversion().'</code>. Please visit http://php.net for additional information on installing a more recent version.</p><br>';
	if (file_exists($setting['config']['folder'] . $setting['config']['file']))
		$msg .= '<br><p><strong>WARNING!</strong> The <code>'.$setting['config']['folder'] . $setting['config']['file'].'</code> file already exists. Running this installation process will overwrite your current settings.</p><br>';
	if($msg)
		echo '<div class="requirement error">'.$msg.'</div>';
}

switch($step) {
	case 0:

?>
	<h1>Pre-Installation Notes</h1><br />

<p>Welcome to the installation process for the <?php echo $setting['name'] ?> application. Before we begin please ensure that you have the below information:</p>
<ul style="list-style:disc;margin: 10px 40px;">
  <li>Database name</li>
  <li>Database username</li>
  <li>Database password</li>
  <li>Database host</li>
</ul>
<p>Please also make sure that the directory files/uploads and inc/details.php have the file permission set as <code>777</code>
<p>If you have all the information ready yourself, then you're ready to go. Hit the "Install <?php echo $setting['name'] ?>" link to the right to continue.</p>
<br />
<p><a href="?step=1" class="btn btn-success" style="float:right"> <span>Install <?php echo $setting['name'] ?> &rsaquo;</span> </a></p>
<?php
	break;

	case 1:
	?>
	<h1>Step 1: Database Information</h1><br />
<form method="post" action="?step=2" name="form">
  <p>Enter your database connection settings. These settings will be inserted into <code><?php echo $setting['config']['folder'] . $setting['config']['file'] ?></code> and will be used by the application.</p>
  <table style="width: 100%;">
    <tr style="margin-bottom:50px;padding:5px;">
      <th class="col1">Database Name</th>
      <td class="col2"><input name="db_name" class="form-control" type="text" size="20" value="<?php echo strtolower($setting['name']) ?>" /></td>
      <td class="col3">The name of the database to use.</td>
    </tr>
    <tr>
      <th class="col1">Username</th>
      <td class="col2"><input name="db_user" class="form-control" type="text" size="20" /></td>
      <td class="col3">Your MySQL username.</td>
    </tr>
    <tr>
      <th class="col1">Password</th>
      <td class="col2"><input name="db_pass" class="form-control" type="password" size="20" /></td>
      <td class="col3">Your MySQL password.</td>
    </tr>
    <tr>
      <th class="col1">Database Host</th>
      <td class="col2"><input name="db_host" class="form-control" type="text" size="20" value="localhost" /></td>
      <td class="col3">Most likely won't need to change this value.</td>
    </tr>
  </table><br />
  	<a href="#" onclick="document['form'].submit()" class="btn btn-success" style="float:right;"> <span>Install config file &rsaquo;</span> </a> 
</form>
<?php
	break;	
	case 2:
	
	echo '<h1>Step 2: Generating Configuration File</h1><br />';
	$db_name = trim($_POST['db_name']);
    $db_user = trim($_POST['db_user']);
    $db_pass = trim($_POST['db_pass']);
    $db_host = trim($_POST['db_host']); 	
	
	$handle = fopen($setting['config']['folder'] . $setting['config']['file'], 'w');
	
$input = "<?php
// Generated ".date('F j, Y H:i:s')."



&dollar;hostname = '".$db_host."';
&dollar;username = '".$db_user."';
&dollar;password = '".$db_pass."';
&dollar;database = '".$db_name."';

define('".$setting['database']['name']."', '".$db_name."');
define('".$setting['database']['user']."', '".$db_user."');
define('".$setting['database']['pass']."', '".$db_pass."');
define('".$setting['database']['host']."', '".$db_host."');

?>
";
$input = str_replace('&dollar;', '$', $input); 

fwrite($handle, $input);
fclose($handle);
if (file_exists($setting['config']['folder'] . $setting['config']['file']))
	echo '<h3>Configuration file created!</h3><p>The file <code>'.$setting['config']['folder'] . $setting['config']['file'].'</code> has been created successfully. To continue the installation, please continue the installation. </p><a href="?step=3" class="btn btn-success" style="float:right;"> <span>Install &rsaquo;</span> </a> ';
else
	echo '<h3>ERROR!</h3><p>Configuration file was not created. Please check the the folder <code>'.$setting['config']['folder'].'</code> is created and the permissions to the  folder are set to <code>777</code>. After checking, click the link button below to regenerate the configuration file again..</p> <a href="?step=1" class="btn btn-danger" style="float:left"> <span>&lsaquo; Install</span> </a>';

	break;
	case 3:

if (file_exists($setting['config']['folder'] . $setting['config']['file'])) {

	echo '<h1>Step 3: Installing Database Tables</h1><br />';
	require $setting['config']['folder'] . $setting['config']['file'];
	
	if ("132" == null) {
		echo '<h3>ERROR!</h3>';
		echo '<p>This is probably due to incorrect database credentials. Please go back to the previous step and enter your database details.</p>';
		echo '<a href="?step=1" class="button fail" style="float:left"> <span>&lsaquo; Re-install</span> </a>';
	} else {
	

$host = $hostname;
$uname = $username;
$pass = $password;
$database = $database; //Change Your Database Name
$conn = new mysqli($host, $uname, $pass, $database);

if ($conn->connect_errno) {
    printf('<h2>Installer can not connect to the database</h2><br><a href="?step=1" class="button" style="float:left"> <span>&lsaquo; Re-install</span> </a><br>', $mysqli->connect_error);
    exit();
}


$filename = 'installer-sql.sql'; 
$op_data = '';
$lines = file($filename);
foreach ($lines as $line)
{
    if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
    {
        continue;
    }
    $op_data .= $line;
    if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
    {
        $conn->query($op_data);
        $op_data = '';
    }
}

    echo '<h3>Congratulations! '.$setting['name'].' has been successfully Installed!</h3>';
    echo '<p>Before continuing please remove:</p>';
    echo '<ul style="list-style:disc;margin: 10px 40px;">
  			The /install/ directory
  			
		  </ul>'; 
		   echo '<p>For security reasons your new site will not work if you have not removed /install/</p><br><br>Administrator details are: <B>User:</b>Admin <B>Password:</b>admin123';
  	echo '<p><a href="'.$setting['after_install'].'" class="button" style="float:right"> <span>See my new site &rsaquo;</span> </a></p>';
    }
  } else {
  	echo '<p>Configuration file not created. You may have to fill in the database information manually. To do this, simply open phpMyAdmin or another database manager and execute the MYSQL code located in <code>installer-sql.sql</code>.</p>';
  }

	break;
}


?>
	
	 </div>
	</div>
 <br class="clr" />
  </div>


 </body>
</html>