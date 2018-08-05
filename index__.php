<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "home";

$sort = $_GET['s'];
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
              <div class="col-md-12 contentbg" style="padding:10px;">
                <div class="contentcontainer">
                
                
                
                    
                    <div style="margin-bottom:10px">
                        <a href="index.php" <?php if(empty($sort)) { ?>class="btn btn-primary"<?php 
                       }else{ ?> <?php 
} ?>class="btn btn-default">Latest</a>
                        <a href="index.php?s=rated" <?php if($sort == "rated") { ?>class="btn btn-primary"<?php 
                       }else{ ?> <?php 
} ?>class="btn btn-default">Top Rated</a>
                        <a href="index.php?s=popular" <?php if($sort == "popular") { ?>class="btn btn-primary"<?php 
                       }else{ ?> <?php 
} ?>class="btn btn-default">Popular</a>
                        <a href="index.php?s=random" <?php if($sort == "random") { ?>class="btn btn-primary"<?php 
                       }else{ ?> <?php 
} ?>class="btn btn-default">Random</a>
                    </div>
                    <div class="row">
                    
        <?php
        if(empty($sort)) {
            $sql = "SELECT * FROM games WHERE status = '1' ORDER BY id DESC LIMIT 30";
        }
        if($sort == "latest") {
            $sql = "SELECT * FROM games WHERE status = '1' ORDER BY id DESC LIMIT 30";
        }
        if($sort == "rated") {
            $sql = "SELECT * FROM games WHERE status = '1' ORDER BY current_votes DESC LIMIT 30";
        }
        if($sort == "popular") {
            $sql = "SELECT * FROM games WHERE status = '1' ORDER BY view_count DESC LIMIT 30";
        }
        if($sort == "random") {
            $sql = "SELECT * FROM games WHERE status = '1' ORDER BY rand() LIMIT 30";
        }
                    
        $stm = $dbh->prepare($sql);
        $stm->execute();
        $games = $stm->fetchAll();

        $count = 0;
        foreach ($games as $g) {
                        
            $count = $count + 1;
            ?>
                    <a href="game.php?g=<?php echo $g['url'];?>">
                    <div class="col-sm-3 col-lg-3 col-md-4">                        
                    <div class='wrapper' >
            <?php if("hello" == "hello") { ?>
                        <span style="background:#d72633;padding:5px 10px;border-radius:3px;color:white;position:absolute;margin:10px 10px;">NEW</span>
            <?php } ?>
                        <img class="img-responsive img-responsive2" src='<?php echo $g['image']; ?>' />
                                                
                        <div class='description'>
                            <p class='description_content'><?php echo $g['title']; ?></p>                            
                        </div>
                    </div>
                        
                    </div></a>
            <?php 
                    
        }
        if($count == 0) {
            ?>
                        <div class="row"><div class="container">
                            <div class="alert alert-warning" role="alert">There are no existing games</div>
                        </div></div>
            <?php 
        }
        ?>
                    
                         
                    </div>
                <a href="games.php" class="btn btn-primary">View ALL games</a>
                </div>
                
                
              </div>
              
             
            </div>
        </div>


    <?php require "inc/themes/user/footer.php" //This will be where the footer comes from ?>
    
        
    </body>
</html>
