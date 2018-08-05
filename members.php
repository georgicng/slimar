<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "members";


?>
<!DOCTYPE html>
<html>
<head>
<?php require 'inc/themes/user/head.php' ?>
</head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/emojione/1.3.0/assets/css/emojione.min.css"/>
<link rel="stylesheet" href="shoutbox/assets/css/styles.css" />

<body class="game" id="page">
<?php require 'inc/themes/user/header.php' //This will be the navigation ?>



<div class="container">
            <div class="row">
              <div class="col-md-8 contentbg" style="padding:10px;">
                <div class="contentcontainer">
            <div class="container-header blue-header">Members</div>
                    
                    <div class="row">
        <?php
        $sql = "SELECT * FROM users ORDER BY usergroup DESC, id desc";
        $stm = $dbh->prepare($sql);
        $stm->execute();
        $u = $stm->fetchAll();

        $count = 0;
        foreach ($u as $user) {
            //Gets user profile picture 
            if(get_gravatar($user['email']) && $user['gravatar'] == "1") {
                $profilepic = get_gravatar($user['email']);
            }else{
                $profilepic = $user['profilepic'];
            }
                        
            //Gathers users permissions
            $stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
            $stmt1->bindValue(':id', $user['usergroup']);
            $stmt1->execute(); 
            $in_perm2 = $stmt1->fetch();
            ?>

                    <a href="profile.php?u=<?php echo $user['username'];?>"><div class="col-xs-4 col-sm-1  col-md-3">
                        <div class="thumbnail">
                            <img src="<?php echo $profilepic; ?>" style="width:150px;height:150px;" alt="...">
                            <div class="hidden-sm hidden-xs ">
                            <div class="text align-center" style="Font-size:14pt;">
                                <font style="<?php echo $in_perm2['css'];?>"><?php echo $user['username'];?></font>
                            </div>
                            </div>
                        </div>
                    </div></a>
                    
            <?php
        }
                    
        ?>
                         
                    </div>
                    
                    
                </div>
                
                
              </div>
              
              <div class="col-md-4" style="padding:10px;">
                <?php require "inc/themes/user/side.php"; ?>
              </div>
            </div>
        </div>


<?php require "inc/themes/user/footer.php" //This will be where the footer comes from ?>

</body>


</html>
