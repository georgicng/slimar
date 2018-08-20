<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_games";
//Sets last active time for forums [This is to check if the user is online or not]

if (!$in_perm['has_admin']) {
    header("location: ../index.php");
    exit;
}

if (empty($_GET['p'])) {
    $page = "home";
} else {
    $page = $_GET['p'];
}
?>

<!DOCTYPE html>
<html>
<head>
<?php require "inc/head.php"; ?>
</head>

<body>
    <?php require "inc/header.php"; ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">            
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                <li><a href="manage_games.php"> Manage Games</a></li>
            </ol>
        </div><!--/.row-->
    <?php if($_GET['success'] == "game") {?>
        <div class="alert bg-success" role="alert">
            <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Game successfully updated</a>
        </div>
    <?php } ?>
    <?php if($_GET['success'] == "fileuploaded") {?>
        <div class="alert bg-success" role="alert">
            <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> File successfully updated</a>
        </div>
    <?php } ?>
        
    <?php if ($page == "home") { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage games <a href="manage_games.php?p=add" style="float:right;"class="btn btn-primary">Add new game</a></div>
                    <div class="panel-body">
                        <table data-toggle="table" data-url="tables/data3.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="title"  data-sortable="true">Game Name</th>
                                <th data-field="category" data-sortable="true">Category</th>
                                <th data-field="comments" data-sortable="true">Comments</th>
                                <th data-field="date" data-sortable="true">Date added</th>
                                <th data-field="status" data-sortable="true">Status</th>
                                <th data-field="edit" data-sortable="true">Edit</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php } ?>
    
    <?php if ($page == "delete") { 
        //Gathers users
        $stmt = $dbh->prepare("SELECT * FROM games WHERE `id` = :id"); 
        $stmt->bindValue(':id', $_GET['game']);
        $stmt->execute(); 
        $game = $stmt->fetch();
            
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
        $stmt1->bindValue(':id', $in['usergroup']);
        $stmt1->execute(); 
        $in_perm = $stmt1->fetch();
            
        if($_POST['deletegame']) {
            activitylog(''.$in['username'].'', 'deleted game'.$game['title'].'', ''.time().'', 'Admin');
            $sql = "DELETE FROM `games` WHERE id = '".$game["id"]."'";
            $dbh->exec($sql);
            header("location: manage_games.php");   
        }
            
    ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete <?php echo $game['title']; ?></div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="viewprofile">
                                    Are you sure you would like to delete this game? This can not be undone!!<br />                    
                                </label>
                            </div>
                            <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Delete game" name="deletegame"> 
                            <a class="btn btn-primary" href="manage_games.php">Cancel</a>
                        </form>    
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php } ?>
        
        
    <?php if ($page == "add") {

        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
        $stmt1->bindValue(':id', $in['usergroup']);
        $stmt1->execute(); 
        $in_perm = $stmt1->fetch();            
            
    ?>
        <div class="panel panel-default">
                <div class="panel-heading">Add new game</div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">                        
                        <form method="post">
                        <?php
                            //Update settings
                            if(isset($_POST['addgame'])) {
                                if($in["username"]) {
                                            
                                    //Last id
                                    $stmt1 = $dbh->prepare("SELECT * FROM games ORDER BY id desc LIMIT 1"); 
                                    $stmt1->execute(); 
                                    $last_id = $stmt1->fetch();
                                    $latestid = $last_id['id'] + 1;
                                    //$currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
                                    $currenturl = $i['url'];
                                            
                                    $random = rand();
                                    $stmt = $dbh->prepare("INSERT INTO games (id, title, description, category_id, status, url) VALUES (:id, :title, :description, :category_id, :status, :url)");
                                    $stmt->bindParam(':id', $latestid);
                                    $stmt->bindParam(':title', $_POST['title']);
                                    $stmt->bindParam(':description', $_POST['description']);
                                    $stmt->bindParam(':category_id', $_POST['category_id']);
                                    $stmt->bindParam(':status', $_POST['status']);
                                    $stmt->bindParam(':url', $random);
                                    $stmt->execute();
                                                
                                    header("location: ".$currenturl."/admin/manage_games.php?p=edit&game=".$latestid."");
                                            
                                }
                            }
                        ?>              
                            
                            <div class="form-group">
                                <label for="name">Game name</label>
                                <input type="text" class="form-control" id="name" name="title" placeholder="Game name">
                            </div>                     
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" id="name" name="description" placeholder="Give a description for the game"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hide_offline">Category<br />
                                    <select class="form-control" id="hide_offline" name="category_id">                    
                                    <?php
                                        $sql2 = "SELECT * FROM games_categories ORDER BY ID ASC";
                                        $stm2 = $dbh->prepare($sql2);
                                        $stm2->execute();
                                        $nodes2= $stm2->fetchAll();
                                        $count = 0;
                                        foreach ($nodes2 as $n1) {
                                                
                                    ?>
                                        <option value="<?php echo $n1['id']; ?>">
                                            <?php echo $n1['title']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="status">Status<br />
                                    <select class="form-control" id="status" name="status">                                    
                                        <option value="1">
                                            Active
                                        </option>
                                        <option value="0">
                                            Inactive
                                        </option>
                                    </select>
                                </label>
                            </div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Add Game" name="addgame">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
       
    <?php if ($page == "edit") {
        //Gathers users
        $stmt = $dbh->prepare("SELECT * FROM games WHERE `id` = :id"); 
        $stmt->bindValue(':id', $_GET['game']);
        $stmt->execute(); 
        $game = $stmt->fetch();
            
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
        $stmt1->bindValue(':id', $in['usergroup']);
        $stmt1->execute(); 
        $in_perm = $stmt1->fetch();     
    ?>
        <div class="panel panel-default">
                <div class="panel-heading">Edit: <?php echo $game['title']; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">  
                        <form method="post">                  
                        <?php
                            //Update settings
                            if (isset($_POST['updategame_settings'])) {
                                if ($in["username"]) {
                                            
                                    $currenturl = $i['url'];
                                    activitylog(''.$in['username'].'', 'edited game: '.$game['title'].'', ''.time().'', 'Admin');
                                                
                                    $sql = $dbh->prepare("UPDATE games SET title='".$_POST['title']."', description='".$_POST['description']."', category_id='".$_POST['category_id']."', status='".$_POST['status']."' WHERE id=".$game['id']."");
                                    $sql->execute();
                                                
                                    $success = "".$game['title']." has been updated!";
                                    header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=game");
                                            
                                }
                            }

                        ?>   
                            <div class="form-group">
                                <label for="name">Game name</label>
                                <input type="text" class="form-control" id="name" name="title" placeholder="Game name" value="<?php echo $game['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Give a description for the game"><?php echo $game['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hide_offline">Category<br />
                                    <select class="form-control" id="hide_offline" name="category_id">                    
                                    <?php
                                        $sql2 = "SELECT * FROM games_categories ORDER BY ID ASC";
                                        $stm2 = $dbh->prepare($sql2);
                                        $stm2->execute();
                                        $nodes2= $stm2->fetchAll();
                                        $count = 0;
                                        foreach ($nodes2 as $n1) {
                                                
                                    ?>
                                        <option value="<?php echo $n1['id']; ?>" <?php if($game['category_id'] == "".$n1['id']."") { echo 'selected'; 
                                            } ?>>
                                            <?php echo $n1['title']; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="status">Status<br />
                                    <select class="form-control" id="status" name="status">
                                    
                                        <option value="1" <?php if($game['status'] == "1") { echo 'selected'; 
                                    } ?>>Active</option>
                                        <option value="0" <?php if($game['status'] == "0") { echo 'selected'; 
                                    } ?>>Inactive</option>
                                    </select>
                                </label>
                            </div>              
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Update Game" name="updategame_settings">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">            
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name">Cover File</label><br>
                            <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $("#changetype2").change(function(){
                                        $(this).find("option:selected").each(function(){
                                            var optionValue = $(this).attr("value");
                                            if(optionValue){
                                                $(".box1").not("." + optionValue).hide();
                                                $("." + optionValue).show();
                                            } else{
                                                $(".box1").hide();
                                            }
                                        });
                                    }).change();
                                });
                            </script>
                            <select class="form-control" id="changetype2">
                                <option value="cover1">Upload Cover</option>
                                <option value="cover2">Image from URL</option>
                            </select>
                            <style>
                                .box{
                                    padding-left:20px;
                                    display: none;
                                    margin-top: 20px;
                                }
                                .box1{
                                    padding-left:20px;
                                    display: none;
                                    margin-top: 20px;
                                }
                            </style>                        
                            <?php
                                $stmt = $dbh->prepare("SELECT * FROM games WHERE `id` = :id"); 
                                $stmt->bindValue(':id', $_GET['game']);
                                $stmt->execute(); 
                                $game = $stmt->fetch();
                               
                                if(isset($_POST["uploadimage"])) {
                                    //Upload avatar
                                    $target_dir = "../files/uploads/";
                                    $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
                                    $new_name = uniqid()."-".str_replace(" ", "_", $_FILES["imageToUpload"]["name"]);
                                    $target_file2 = $target_dir . basename($new_name);
                                    $uploadOk = 1;
                                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                                    // Check if image file is a actual image or fake image
                                    $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
                                    if($check !== false) {
                                        $uploadOk = 1;
                                    } else {
                                        $uploadOk = 0;
                                    }
                                    // Check if file already exists
                                    if (file_exists($target_file)) {
                                        $uploadOk = 0;
                                    }
                                    // Check file size
                                    if ($_FILES["imageToUpload"]["size"] > 1500000) {
                                        $uploadOk = 0;
                                    }
                                    // Allow certain file formats
                                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                        && $imageFileType != "gif" 
                                    ) {
                                        $uploadOk = 0;
                                    }
                                    // Check if $uploadOk is set to 0 by an error
                                    if ($uploadOk == 0) {
                                        $error = "Sorry, your picture was not uploaded, try again, or try a different picture!";
                                        // if everything is ok, try to upload file
                                    } else {
                            
                                        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file2)) {
                                
                                            $currenturl = $i['url'];
                            
                                            $sql = $dbh->prepare("UPDATE games SET image='".$currenturl."/files/uploads/".$new_name."' WHERE id=".$game['id']."");
                                            $sql->execute();
                                            $success = "".$currenturl."/files/uploads/".$new_name."";
                                            header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=fileuploaded");
                                        } else {
                                            $error = "Sorry, there was an error uploading your profile picture";
                                        }
                                    }
                                }

                                if(isset($_POST['gameimage'])) {
                                    $sql = $dbh->prepare("UPDATE games SET image='".$_POST['thumbnail']."' WHERE id=".$game['id']."");
                                    $sql->execute();
                                    $success = "".$currenturl."/".$new_name."";
                                    header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=game");
                                }
                            ?>
                            <div class="cover1 box1">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="file" class="btn btn-default" style="float:left;" name="imageToUpload" id="fileToUpload">
                                    <input type="submit" style="float:left;"class="btn btn-primary" value="Upload image" name="uploadimage"><br>
                                </form>
                            </div>                            
                            <div class="cover2 box1">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="text" class="btn btn-default" style="width:80%;text-align:left;float:left;" value="<?php echo $game['image']; ?>" name="thumbnail" placeholder="URL to Thumbnail file">
                                    <input type="submit" style="float:left;"class="btn btn-primary" value="Update "  name="gameimage"><br>
                                </form>
                            </div>
                        </div>
                        <div class="form-group">
                            <br><br>
                            <label for="name">Game File</label><br>
                            <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $("#changetype").change(function(){
                                        $(this).find("option:selected").each(function(){
                                            var optionValue = $(this).attr("value");
                                            if(optionValue){
                                                $(".box").not("." + optionValue).hide();
                                                $("." + optionValue).show();
                                            } else{
                                                $(".box").hide();
                                            }
                                        });
                                    }).change();
                                });
                            </script>
                            <select class="form-control" id="changetype">
                                <option value="1">Upload SWF</option>
                                <option value="2">File URL [Flash SWF]</option>
                                <option value="3">File URL (HTML5)</option>
                                <option value="4">Embedded (HTML5)</option>
                            </select>
                            <style>
                                .box{
                                    padding-left:20px;
                                    display: none;
                                    margin-top: 20px;
                                }
                            </style>
                        
                            <?php
                                $stmt = $dbh->prepare("SELECT * FROM games WHERE `id` = :id");
                                $stmt->bindValue(':id', $_GET['game']);
                                $stmt->execute(); 
                                $game = $stmt->fetch();
                                
                                if(isset($_POST["gamefileswf"])) {
                                    //Upload avatar
                                    $target_dir = "../files/uploads/";
                                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                    $new_name = $location.time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload"]["name"];
                                    $target_file2 = $target_dir . basename($new_name);
                                    $uploadOk = 1;
                                    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
                                    // Check if image file is a actual image or fake image
                                    $uploadOk = 1;
                                    // Check if file already exists
                                    if (file_exists($target_file)) {
                                        $uploadOk = 0;
                                    }
                                    // Check file size
                                    if ($_FILES["fileToUpload"]["size"] > 55500000) {
                                        $uploadOk = 0;
                                    }
                                    // Allow certain file formats
                                    if($fileType != "swf" ) {
                                        $uploadOk = 0;
                                    }
                                    // Check if $uploadOk is set to 0 by an error
                                    if ($uploadOk == 0) {
                                        echo "Sorry, your file was not uploaded, try again, or try a different file!";
                                        // if everything is ok, try to upload file
                                    } else {
                            
                                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file2)) {
                                            $currenturl = $i['url'];                            
                                            $sql = $dbh->prepare("UPDATE games SET file='".$currenturl."/files/uploads/".$new_name."', type='Flash' WHERE id=".$game['id']."");
                                            $sql->execute();
                                            $success = "".$currenturl."/files/uploads/".$new_name."";
                                            header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=fileuploaded");
                                        } else {
                                            $error = "Sorry, there was an error uploading your file";
                                        }
                                    }
                                }

                                if(isset($_POST['gamefileurl'])) {
                                    $sql = $dbh->prepare("UPDATE games SET file='".$_POST['gamefileurl_text']."', type='Flash' WHERE id=".$game['id']."");
                                    $sql->execute();
                                    $success = "".$_POST['gamefileurl']."";
                                    header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=game");
                                }

                                if(isset($_POST['HTML5-url'])) {
                                    $sql = $dbh->prepare("UPDATE games SET file='".$_POST['html5url-text']."', type='HTML5-url' WHERE id=".$game['id']."");
                                    $sql->execute();
                                    $success = "".$_POST['HTML5-url']."";
                                    header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=game");
                                }

                                if(isset($_POST['HTML5embed'])) {
                                    $sql = $dbh->prepare("UPDATE games SET file='".$_POST['HTML5embed-textarea']."', type='HTML5' WHERE id=".$game['id']."");
                                    $sql->execute();
                                    $success = ""."Embedded"."";
                                    header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=game");
                                }

                            ?>
                            <div class="1 box">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="file" class="btn btn-default" style="float:left;" name="fileToUpload" id="fileToUpload">
                                    <input type="submit" style="float:left;"class="btn btn-primary" value="Upload SWF" name="gamefileswf"><br>
                                </form>
                            </div>
                            <div class="2 box">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="text" class="btn btn-default" style="width:80%;text-align:left;float:left;" value='<?php echo $game['file']; ?>' name="gamefileurl_text" placeholder="URL to SWF file">
                                    <input type="submit" style="float:left;"class="btn btn-primary" value="Update "  name="gamefileurl"><br>
                                </form>
                            </div>
                            <div class="3 box">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="text" class="btn btn-default" style="width:80%;text-align:left;float:left;" value='<?php echo $game['file']; ?>' name="html5url-text" placeholder="URL to html5 file">
                                    <input type="submit" style="float:left;"class="btn btn-primary" value="Update " name="HTML5-url"><br>
                                </form>
                            </div>
                            <div class="4 box">
                                <form method="post" enctype="multipart/form-data">
                                    <textarea type="text" class="btn btn-default" style="width:100%;text-align:left;height:200px;" name="HTML5embed-textarea" placeholder="Enter game scripts here"><?php echo $game['file']; ?></textarea>                                    
                                    <br><br>
                                    <input type="submit" style=""class="btn btn-primary" value="Update " name="HTML5embed"><br>
                                </form>
                            </div>   
                        </div>                                           
                    </div>
                </div>
            </div>    
        </div><!--/.row-->
    <?php } ?>

        
    </div>    <!--/.main-->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    
    <script src="js/bootstrap-table.js"></script>
    
    <script>
        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
                $(this).find('em:first').toggleClass("glyphicon-minus");      
            }); 
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
          if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
          if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>    
</body>

</html>
