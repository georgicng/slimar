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
    </head>

    <body class="home" id="page">
    <?php require 'inc/themes/user/header.php' //This will be the navigation ?>

    <?php if(!$error) { echo '<div style="height:10px"></div>'; 
    } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary contentbg" style="border:1px solid #131519;" >
                    <div class="panel-heading" style="background:#131519;border:1px solid #131519;">
                        Sign up
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
        <?php if($i['registeration'] == "1") { ?>
                            <div class="col-lg-12">
                                <form class="form" method="post">
                                        <div class="form-group">
                                             <label for="exampleInputEmail2">Username</label>
                                             <input type="text" name="username" class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                             <label for="exampleInputEmail2">First name</label>
                                             <input type="text" name="firstname" class="form-control" placeholder="First name" required>
                                        </div>
                                        <div class="form-group">
                                             <label  for="exampleInputEmail2">Email address</label>
                                             <input type="email" name="email" class="form-control" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                             <label  for="exampleInputEmail2">Date of birth</label>
                                             <input type="date" name="dob" class="form-control" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                             <label for="exampleInputPassword2">Password</label>
                                             <input type="password" name="password" class="form-control" placeholder="Password" required>
                                             
                                        </div>
                                        <div class="form-group">
                                             <label for="exampleInputPassword2">Confirm Password</label>
                                             <input type="password" name="password2" class="form-control" placeholder="Password" required>
                                             
                                        </div>
                                        <div class="form-group">
                                             <label for="referral">OPTIONAL: Referred by <small>Enter username of user that invited you</small></label>
                                             <input type="text" name="refer" class="form-control" placeholder="" value="<?php echo $_GET['refer']; ?>">
                                             
                                        </div>
                                        <div class="form-group">
            <?php if($i['captcha_reg'] == "1") { ?>
                                            <img src="inc/captcha.php" style="float:left;"/>
                                            <input placeholder='Captcha' style="width:170px;padding:9px;color:#272727;" maxlength="4" name="captcha" type="text">
            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                             <input type="submit" name="register" class="btn btn-pink btn-block" value="Register">
                                            
                                        </div>

                                    
                                    
                                </form>
                                
                            </div>
        <?php }else{ ?>
                        <div class="col-lg-12">
                        Registeration is currently closed!
                        </div>
        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height:100px"></div>


    <?php require "inc/themes/user/footer.php" //This will be where the footer comes from ?>
    
        
    </body>
</html>
