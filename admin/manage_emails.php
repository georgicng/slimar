<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_emails";
//Sets last active time for forums [This is to check if the user is online or not]

if(!$in_perm['has_admin']) {
    header("location: ../index.php");
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
<?php require "inc/head.php"; ?>
</head>

<body>
    <?php require "inc/header.php"; ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">            
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                <li><a href="manage_emails.php"> Manage Emails</a></li>
            </ol>
        </div><!--/.row-->
        <br>
    <?php if($_GET['success'] == "user") {?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> User's profile successfully updated</a>
        </div>
    <?php } ?>
        
    <?php if ($page == "home") { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Select email template</div>
                    <div class="panel-body">
                    
                    
                    <form method="post">
                        <div class="form-group">
        <?php
        if(isset($_POST["updatetemplate"])) {
            $sql = $dbh->prepare("UPDATE site_settings SET email_template='".$_POST['template']."'");
            $sql->execute();
        }
                            
        ?>
                            <label>What template would you like to use for emails?</label>
                            <select name="template" class="form-control">
                            
        <?php 
                            
                            
        $sql2 = "SELECT * FROM email_templates ORDER BY ID ASC";
        $stm2 = $dbh->prepare($sql2);
        $stm2->execute();
        $templates = $stm2->fetchAll();
        $count = 0;
                                
                            
                            
        foreach ($templates as $t1) {
            ?>
                            <option value="<?php echo $t1['id']; ?>" <?php if($i['email_template'] == $t1['id']) { echo 'selected'; 
                           } ?> ><?php echo $t1['name']; ?></option>
                            
        <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <input type="submit" style="float:left;"class="btn btn-primary" value="Update template" name="updatetemplate">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage email templates 
                    
                    <a href='manage_emails.php?p=new' class='btn btn-success'><i class='fa fa-plus' aria-hidden='true'></i> Add new template</a> </div>
                    <div class="panel-body">
                        
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            
        <?php
        $sql2 = "SELECT * FROM email_templates ORDER BY ID ASC";
        $stm2 = $dbh->prepare($sql2);
        $stm2->execute();
        $templates = $stm2->fetchAll();
        $count = 0;
                                
                            
                            
        foreach ($templates as $t1) {
            ?><tr>
                                <td>
            <?php echo $t1['id']; ?>
                                </td>
                                <td>
            <?php echo $t1['name']; ?>
                                </td>
                                <td>
            <?php 
            if($t1['id'] == $i['email_template']) { echo '<font style="color:green;">Active</font>'; 
            }else{ echo 'Not active'; 
            } 
            ?>
                                </td>
                                <td>
                                    <a href='manage_emails.php?p=edit&id=<?php echo $t1['id']; ?>' class='btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a> 
                                    <a href='manage_emails.php?p=delete&id=<?php echo $t1['id']; ?>' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> </td>
                                </td>
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
        $stmt1 = $dbh->prepare("SELECT * FROM email_templates WHERE `id` = :id"); 
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute(); 
        $group = $stmt1->fetch();
            
            
        if(isset($_POST['updatetemplate'])) {

            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'updated template '.$group['name'].'', ''.time().'', 'Admin');
                    
            $sql = $dbh->prepare("UPDATE email_templates SET name='".$_POST['title']."', content='".$_POST['content']."' WHERE id=".$group['id']."");
            $sql->execute();
            header("location: manage_emails.php");

        }
        ?>
        <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Edit</a></li>
    <li role="presentation"><a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">Preview</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit email template: <?php echo $group['name']; ?></div>
                    <div class="panel-body">
                    
                        <div class="row">
                          <div class="col-md-7">
                          
                          <form method="post">
                            <div class="form-group">
                                <label>Template name</label>
                                <input type="text" class="form-control" name="title" value="<?php echo $group['name']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>HTML Code for template</label>
                                <textarea class="form-control" name="content" style="height:500px"><?php echo $group['content']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update template" name="updatetemplate">
                            </div>
                          </form>
                          
                          </div>
                          <div class="col-md-5">
                            <div class="well well-lg">
                            <b style="font-size:12pt;">Please note:</b><br>
                            This is only a template and not an actual email
                            
                            </div>
                            <div class="well well-lg">
                            <b style="font-size:12pt;">Shortcodes:</b><br>
                            <b>Site title:</b> %site_title%<br>
                            <b>Email subject:</b> %email_title%<br>
                            <b>Email content:</b> %email_content%<br>
                            <b>Email footer:</b> %email_footer%<br>
                            
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="preview">
    <iframe src="preview_template.php?id=<?php echo $group['id']; ?>" frameBorder="0" width="100%" height="500px" style="background:white;"></iframe>
    </div>
  </div>

</div>

        

    <?php } ?>
        
    <?php if ($page == "new") { 
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM email_templates WHERE `id` = :id"); 
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute(); 
        $group = $stmt1->fetch();
            
            
        if(isset($_POST['newtemplate'])) {

            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'updated template '.$group['name'].'', ''.time().'', 'Admin');
                    
            $stmt = $dbh->prepare("INSERT INTO email_templates (name, content) VALUES (:name, :content)");
            $stmt->bindParam(':name', $_POST['title']);
            $stmt->bindParam(':content', $_POST['content']);
            $stmt->execute();
            header("location: manage_emails.php");

        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">New email template</div>
                    <div class="panel-body">
                    
                        <div class="row">
                          <div class="col-md-7">
                          
                          <form method="post">
                            <div class="form-group">
                                <label>Template name</label>
                                <input type="text" class="form-control" name="title" placeholder="Name of new template"></input>
                            </div>
                            <div class="form-group">
                                <label>HTML Code for template - Use shortcodes on the right side</label>
                                <textarea class="form-control" name="content" style="height:500px" placeholder="HTML & CSS of template"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Create template" name="newtemplate">
                            </div>
                          </form>
                          
                          </div>
                          <div class="col-md-5">
                            <div class="well well-lg">
                            <b style="font-size:12pt;">Please note:</b><br>
                            This is only a template and not an actual email
                            
                            </div>
                            <div class="well well-lg">
                            <b style="font-size:12pt;">Shortcodes:</b><br>
                            <b>Site title:</b> %site_title%<br>
                            <b>Email subject:</b> %email_title%<br>
                            <b>Email content:</b> %email_content%<br>
                            <b>Email footer:</b> %email_footer%<br>
                            
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

    <?php } ?>
        
    <?php if ($page == "delete") { 
        //Gathers users
        $stmt1 = $dbh->prepare("SELECT * FROM email_templates WHERE `id` = :id"); 
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute(); 
        $group = $stmt1->fetch();
            
        if($_POST['deletegroup']) {
            activitylog(''.$in['username'].'', 'deleted usergroup: '.$group['name'].'', ''.time().'', 'Admin');
                
        
            $sql = "DELETE FROM `email_templates` WHERE id = '".$group["id"]."'";
            $dbh->exec($sql);
            header("location: manage_emails.php");   
        }
            
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete <?php echo $group['name']; ?></div>
                    <div class="panel-body">
                    <form method="post">
                    <div class="form-group">
                <label for="viewprofile">Are you sure you would like to delete this email template? This can not be undone!!<br />
                    
                </label>
              </div>
              <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Delete template" name="deletegroup"> 
                 <a class="btn btn-primary" href="manage_emails.php">Cancel</a>
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
