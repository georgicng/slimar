<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "game";


$url = $_GET['g'];

$stmt = $dbh->prepare("SELECT * FROM games WHERE `url` = :url"); 
$stmt->bindValue(':url', $url);
$stmt->execute(); 
$cur_game = $stmt->fetch();

if($cur_game['id']) {
    $stmt = $dbh->prepare("SELECT * FROM games_categories WHERE `id` = :category_id"); 
    $stmt->bindValue(':category_id', $cur_game['category_id']);
    $stmt->execute(); 
    $cur_game_category = $stmt->fetch();
}
//Whether to show this page or not
if($i['direct_game'] == "1") {
    header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <?php require 'inc/themes/user/head.php' ?>
        
        <link href="files/css/rating.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="files/js/rating.js"></script>
    </head>

    <body class="home" id="page">
    <?php require 'inc/themes/user/header.php' //This will be the navigation ?>



    
        <div class="container">
        
            <div class="row">
              <div class="col-md-8 contentbg" style="padding:10px;">
                <div class="contentcontainer">
                    
                    <div class="row">
                    
        <?php if($cur_game['id']) {?>
                    <div class="col-sm-4 col-lg-5 col-md-4">
                                            
                    <div class='wrapper'>
                        <img class="img-responsive" src='<?php echo $cur_game['image']; ?>' />
                        
                    </div>
                        
                    </div>
                    
                    <div class="col-sm-6 col-lg-7 col-md-7">
                    
                    <font style="font-size:20pt;"><?php echo $cur_game['title']; ?></font><br>
                    <B>Date:</b> <?php echo date('M d, Y', $cur_game['date']); ?> - 
                    <b>Category:</b> <a href="cat.php?c=<?php echo $cur_game_category['title']; ?>"> <?php echo $cur_game_category['title']; ?></a> - 
                    <b>Rating:</b> 
            <?php
            $positive = $dbh->query("select count(*) from games_rating WHERE game_id = ".$cur_game['id']." && type = 'pos'")->fetchColumn(); 
            $negative = $dbh->query("select count(*) from games_rating WHERE game_id = ".$cur_game['id']." && type = 'neg'")->fetchColumn();
            $total = $positive - $negative;
            ?>        
            <?php 
            if($total < 0) { 
                ?>
                        <span style="color:red;font-weight:bold;"> <?php echo $total; ?></span>
                <?php
            }else{
                ?>
                    <span style="color:green;font-weight:bold;"> <?php echo $total; ?></span>
            <?php } ?>    
                    <br><br><B>Description:</b><br>
            <?php echo $cur_game['description']; ?>
                    <br><br>
                    <a style="float:left;margin-right:10px" href="play.php?g=<?php echo $cur_game['url'];?>" class="btn btn-primary">Play Game</a>
                    
                    
            <?php
            //favourites
            $stmt = $dbh->prepare("SELECT * FROM users_favourites WHERE `game_id` = :game_id && `user_id` = :user_id"); 
            $stmt->bindValue(':game_id', $cur_game['id']);
            $stmt->bindValue(':user_id', $in['id']);
            $stmt->execute(); 
            $fav = $stmt->fetch();
                    
            if(isset($_POST["fav_add"])) {
                $stmt = $dbh->prepare("INSERT INTO users_favourites (game_id, user_id) VALUES (:game_id, :user_id)");
                $stmt->bindParam(':game_id', $cur_game['id']);
                $stmt->bindParam(':user_id', $in['id']);
                $stmt->execute();
                header("location: ".$currenturl."/game.php?g=".$cur_game['url']."");
            }
            if(isset($_POST["fav_remove"])) {
                $sql = "DELETE FROM `users_favourites` WHERE game_id = '".$cur_game["id"]."' && user_id = '".$in["id"]."'";
                $dbh->exec($sql);
                header("location: ".$currenturl."/game.php?g=".$cur_game['url']."");
            }

                    
            if($fav['id']) {
                ?>
                    <form method="post" style="float:left;">
                    <button type="submit" class="btn btn-fav" name="fav_remove"><i class="fa fa-heart" aria-hidden="true"></i> Favourited</button>
                    </form>
            <?php }else{ ?>
                    <form method="post" style="float:left;">
                    <button type="submit" class="btn btn-fav2" name="fav_add"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to favourites</button>
                    </form>
            <?php } ?>
                    
                    </div>
        <?php }else{ ?>
                    <div class="col-sm-6 col-lg-7 col-md-7"><b style="color:#cf000f;">Notice:</b> This game does not exist!</div>
        <?php } ?>
                    </div>
                
                </div>
                
                
                <?php if($i['ads_enabled'] == "1") { ?>
                <div class="contentcontainer" style="background:#1s31519;">
                    <div class="container-header blue-header">Advertisement</div>
                    <div class="content-container">

                    <?php echo $i['ad_2']; ?>
                    </div>
                </div>
                <?php } ?>
                
              </div>
              
              <div class="col-md-4" style="padding:10px;padding-top:0px;">
                <?php require "inc/themes/user/side.php"; ?>
              </div>
            </div>
        </div>


    <?php require "inc/themes/user/footer.php" //This will be where the footer comes from ?>
    
        
    </body>
</html>
