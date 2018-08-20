<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_categories";
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
                <li><a href="manage_categories.php"> Manage Categories</a></li>
            </ol>
        </div><!--/.row-->
        <br>
    <?php if($_GET['success'] == "user") {?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> category successfully updated</a>
        </div>
    <?php } ?>
        
    <?php if ($page == "home") { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new category</div>
                    <div class="panel-body">
        <?php
        //Post comment
        if(isset($_POST["addcategory"])) {
                        
            if($in["username"]) {
                            
                $name = $_POST['category_name'];
                            
                            
                activitylog(''.$in['username'].'', 'added a new category', ''.time().'');
                $stmt = $dbh->prepare("INSERT INTO games_categories (title, status) VALUES (:title, '1')");
                $stmt->bindParam(':title', $name);
                            
                $stmt->execute();
                            
            }
                            
        }
        ?>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="category_name" placeholder="Name of new category" class="form-control"></input>
                            </div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Add category" name="addcategory">
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage categories</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
        <?php
        $sql = "SELECT * FROM games_categories ORDER BY id asc";
        $stm = $dbh->prepare($sql);    
        $stm->execute();
        $u = $stm->fetchAll();
                            
        $count = 0;
        foreach ($u as $ug) {
            ?>
                            <tr>
                                <td><?php echo $ug['id']; ?></td>
                                <td><?php echo $ug['title']; ?></td>
                                
                                <td>
            <?php if($ug['status'] == "1") { ?><span class='label label-success'>Active</span><?php 
            }else{ ?><span class='label label-default'>Inactive</span><?php 
} ?>
                                </td>
                                
                                <td>
                                    <a href='manage_categories.php?p=edit&id=<?php echo $ug['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a> 
                                    <a href='manage_categories.php?p=delete&id=<?php echo $ug['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> </td>
                            </tr>
        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php } ?>

    <?php if ($page == "edit") { 
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM games_categories WHERE `id` = :id"); 
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute(); 
        $category = $stmt1->fetch();
        error_log("out: ".json_encode($_POST));   
            
        if (isset($_POST['updatecategory'])) {
            error_log("In: ".json_encode($_POST));
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'updated category '.$category['title'].'', ''.time().'', 'Admin');
                    
            $update_query = $dbh->prepare("UPDATE games_categories SET title='".$_POST['title']."', status='".$_POST['status']."' WHERE id='".$_GET['id']."'");
            $update_query->execute(); 
            $success = "Category updated";
            header("location: manage_categories.php");

        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit category: <?php echo $category['title']; ?></div>
                    <div class="panel-body">
                    
                        <form method="post">
                            <div class="form-group">
                                <label>Name of category</label>
                                <input type="text" name="title" value="<?php echo $category['title']; ?>" class="form-control"></input>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option <?php if($category['status'] == "1") { echo 'selected'; 
                                   } ?> value="1">Active</option>
                                    <option <?php if($category['status'] == "0") { echo 'selected'; 
                                   } ?> value="0">Inactive</option>
                                </select>
                            </div>
                             <input type="submit" style="float:left;"class="btn btn-primary" value="Update category" name="updatecategory">
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

    <?php } ?>
    <?php if ($page == "delete") { 
        //Gathers users
        $stmt1 = $dbh->prepare("SELECT * FROM games_categories WHERE `id` = :id"); 
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute(); 
        $category = $stmt1->fetch();
            
        if($_POST['deletecategory']) {
            activitylog(''.$in['username'].'', 'deleted category: '.$category['name'].'', ''.time().'', 'Admin');
            $sql = "DELETE FROM `games_categories` WHERE id = '".$category["id"]."'";
            $dbh->exec($sql);
            header("location: manage_categories.php");   
        }
            
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete <?php echo $category['name']; ?></div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="viewprofile">Are you sure you would like to delete this category? This can not be undone!!<br />
                    
                                </label>
                            </div>
                            <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Delete category" name="deletecategory"> 
                            <a class="btn btn-primary" href="manage_categories.php">Cancel</a>
                        </form>    
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
