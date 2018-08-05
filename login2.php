<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "login";

//Checks if user is logged in, if logged in redirects
if($in['id']) {
    echo 'You are already signed in - Redirecting you back to home <meta http-equiv="refresh" content="3;url=index.php" />';
    
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
    <?php require 'inc/themes/user/head.php' ?>
        <link href="files/css/login.css" rel="stylesheet" />

    </head>
    
<body class="game" id="page">
    
    <div class='form animated bounceIn'>
    
    <?php if($error) { ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      
      <strong>ERROR:</strong> <?php echo $error; ?>
    </div>
    <?php } ?>
    
    <h2>Login To Your Account</h2>
    <form  method="post">
        <input placeholder='Email address' name='email' type='email'>
        <input placeholder='Password' name='password' type='password'>    

    <?php if($i['captcha'] == "1") { ?>
        <img src="inc/captcha.php" style="float:left;"/><input placeholder='Captcha' maxlength="4" style="width:225px"  name="captcha" type="text">
    <?php } ?>
                
        <input type="submit" name="login" class='button animated infinite pulse' value="Login">
    <?php if($i['registeration'] == "1") { ?><a href="signup.php"><button class='button animated infinite pulse' style="background:#242e38;" >Sign up</button></a><?php 
    }?>
    </form>
</div>


</body>
</html>
