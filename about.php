<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "about";

?>
<!DOCTYPE html>
<html>
    <head>
    <?php require 'inc/themes/user/head.php' ?>
    </head>

    <body class="home" id="page">
    <?php require 'inc/themes/user/header.php' //This will be the navigation ?>



    
        <div class="container">
        
            <div class="row">
              <div class="col-md-8 contentbg" style="padding:10px;">
                
                
                
                <div class="contentcontainer" style="">
                    <div class="container-header blue-header">About <?php echo $i['title']; ?></div>
                    <div class="content-container">

        <?php echo $i['about']; ?>
                    </div>
                </div>
                
                
              </div>
              
              <div class="col-md-4" style="padding:10px;padding-top:0px;">
                <?php require "inc/themes/user/side.php"; ?>
              </div>
            </div>
        </div>


    <?php require "inc/themes/user/footer.php" //This will be where the footer comes from ?>
    
        
    </body>
</html>
