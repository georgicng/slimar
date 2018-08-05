<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "home";

//Checks if user is logged in, if logged in redirects
if($in['id']) {
    echo 'You are already signed in - Redirecting you back to home <meta http-equiv="refresh" content="3;url=index.php" />';
    
    exit;
}

$p = $_GET['p'];
if(empty($_GET['p'])) {
    $page = "home";
}else{
    $page = $p;
}
?>
<!DOCTYPE html>
<html>
    <head>
    <?php require 'inc/themes/user/head.php' ?>
    </head>

    <body class="home" id="page">
    <?php require 'inc/themes/user/header.php' //This will be the navigation ?>

    <?php if(!$error) { echo '<div style="height:100px"></div>'; 
    } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Forgot password
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
        <?php if ($page == "reset") { ?>
            <?php
            $stmt = $dbh->prepare("SELECT * FROM users WHERE `forgotid` = :forgotid"); 
            $stmt->bindValue(':forgotid', $_GET['u']);
            $stmt->execute(); 
                                
            $row = $stmt->fetch();
                                
            if(isset($_POST['changepassword'])) {
                $newpassword = "".$_POST['password-new']."";
                $confirmpassword = "".$_POST['password-new2']."";
                $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
                                
                                
                if($newpassword == $confirmpassword) {
                    $password_hashed = password_hash($newpassword, PASSWORD_DEFAULT);
                    activitylog(''.$row['username'].'', 'updated their password', ''.time().'');
                                        
                    $sql = $dbh->prepare("UPDATE users SET password='".$password_hashed."' WHERE id=".$row['id']."");
                    $sql->execute();
                                        
                    echo  '<div class="alert alert-success" role="alert">Password updated</div>';
                    setcookie("password", $password_hashed, time()+3600);
                                        
                }else{
                    echo  '<div class="alert alert-danger" role="alert">Two passwords do not match</div>';
                }
            }
            if ($stmt->rowCount()  == 0) {
                echo  '<div class="alert alert-danger" role="alert">Invalid reset code</div>';
                                    
            }else{
                echo '
									<form method="post">
										<div class="form-group">
											<label>New Password</label>
											<input type="password" name="password-new" placeholder="Password" class="form-control"></input>
										</div>
										<div class="form-group">
											<label>Confirm new Password</label>
											<input type="password" name="password-new2" placeholder="Confirm password" class="form-control"></input>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-primary" value="Change password" name="changepassword">
										</div>
									</form>
									';
                                    
            }
            ?>
                            
        <?php } ?>
        <?php if ($page == "home") { ?>
            <?php
            if(isset($_POST['forgotpassword'])) {
                $stmt = $dbh->prepare("SELECT * FROM users WHERE `email` = :email"); 
                $stmt->bindValue(':email', $_POST['forgot_email']);
                $stmt->execute(); 
                                
                $row = $stmt->fetch();

                if ($stmt->rowCount()  < 1) {
                    echo  '<div class="alert alert-danger" role="alert">The email you have entered does not exist</div>';
                                    
                }else{
                    forgotpassword("".$row['username']."", "".$row['email']."", "".$i['email']."", "".$i['emailserver']."", "".$i['title']."", "lala");
                                    
                    echo  '<div class="alert alert-success" role="alert">An email has been sent to '.$row['email'].'</div>';
                    $step2 = "1";
                }
                                
            }
            ?><?php if($step2 != "1") { ?>
                                <form class="form" method="post" id="login-nav">
                                        <div class="form-group">
                                        
                                             <label for="exampleInputEmail2">Your email address</label>
                                             <input type="email" name="forgot_email" class="form-control" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                             <input type="submit" name="forgotpassword" class="btn btn-pink btn-block" value="Send reset to email">
                                        </div>

                                        
                                 
                                    
                                </form>
            <?php } 
        } ?>
                            </div>
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
