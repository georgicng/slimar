<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "login";

//Checks if user is logged in, if logged in redirects
if ($in['id']) {
    echo 'You are already signed in - Redirecting you back to home <meta http-equiv="refresh" content="3;url=index.php" />';
    
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
    <?php require 'inc/themes/user/head.php' ?>
    </head>

    <body class="home" id="page">
    <?php require 'inc/themes/user/header.php' //This will be the navigation?>

    <?php if (!$error) {
        echo '<div style="height:100px"></div>';
} ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Sign in
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form" method="post" id="login-nav">
                                        <div class="form-group">
                                             <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                             <input type="email" name="email" class="form-control" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                             <label class="sr-only" for="exampleInputPassword2">Password</label>
                                             <input type="password" name="password" class="form-control" placeholder="Password" required>
                                             
                                        </div>
                                        <div class="form-group">
            <?php if ($i['captcha'] == "1") {
                ?>
                                            <img src="inc/captcha.php" style="float:left;"/>
                                            <input placeholder='Captcha' style="width:170px;padding:9px;color:#272727;" maxlength="4" name="captcha" type="text">
                <?php
} ?>
                                        </div>
                                        <div class="form-group">
                                             <input type="submit" name="login" class="btn btn-pink btn-block" value="Login">
                                             <input type="submit" name="register" class="btn btn btn-block" value="Register">
                                        </div>

                                        
                                 
                                    
                                    <div class="form-group text-center">
                                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                        <label for="remember"> Remember Me</label> - <a href="forgotpass.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                                    </div>
                                    
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height:100px"></div>


    <?php require "inc/themes/user/footer.php" //This will be where the footer comes from?>
    
        
    </body>
</html>
