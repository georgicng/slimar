<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "site_settings";
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
                <li><a href="site_settings.php"> Site Settings</a></li>
            </ol>
        </div><!--/.row-->
        <br>
    <?php if($_GET['success'] == "settings") {?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Site settings successfully updated!</a>
        </div>
    <?php } ?>
        

        
        
    <?php if ($page == "home") { ?>
        
        
        <?php
        if (isset($_POST['update_sitesettings'])) {
            error_log('settings post:'.json_encode($_POST['settings']));
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'updated site settings', ''.time().'', 'Admin');

            $stmt = $dbh->prepare("TRUNCATE TABLE site_settings");
            $stmt->execute();

            foreach ($_POST['settings'] as $key => $value) {
                $stmt = $dbh->prepare("INSERT site_settings (s_key, s_value) VALUES(:key, :value)");
                $stmt->bindParam('key', $key);
                $stmt->bindParam('value', $value);
                $stmt->execute();
            }

            //$sql = $dbh->prepare("UPDATE site_settings SET title='".$_POST['title']."', url='".$_POST['url']."', offline='".$_POST['offline']."', registeration='".$_POST['registeration']."', loginurl='".$_POST['loginurl']."', captcha='".$_POST['captcha']."', captcha_reg='".$_POST['captcha_reg']."', email='".$_POST['email']."', emailserver='".$_POST['emailserver']."', defaultpic='".$_POST['defaultpic']."', welcome_title='".$_POST['welcome_title']."', welcome_message='".$_POST['welcome_message']."', about='".$_POST['about_message']."'");
            //$sql->execute();
            $success = "Site settings updated";
            header("location: site_settings.php?success=settings");
            
        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage site settings</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Site name</label>
                                <input type="text" name="settings[title]" class="form-control" value="<?php echo $i['title']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Site url address</label>
                                <input type="text" name="settings[url]" class="form-control" value="<?php echo $i['url']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Maintenance <small>Only administrators will be able to view the website</small></label>
                                <select class="form-control" name="settings[offline]">
                                    <option <?php if($i['offline'] == "0") { echo 'selected'; 
                                   } ?> value="0">Online</option>
                                    <option <?php if($i['offline'] == "1") { echo 'selected'; 
                                   } ?> value="1">Offline</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Starting Bonus</label>
                                <input type="text" name="settings[bonus]" class="form-control" value="<?php echo $i['bonus']; ?>"></input>

                            </div>
                            <div class="form-group">
                                <label>Registeration open?</label>
                                <select class="form-control" name="settings[registeration]">
                                    <option <?php if($i['registeration'] == "1") { echo 'selected'; 
                                   } ?> value="1">Yes</option>
                                    <option <?php if($i['registeration'] == "0") { echo 'selected'; 
                                   } ?> value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>After login url <small>Where users will be taken once logged in</small></label>
                                <input type="text" name="settings[loginurl]" class="form-control" value="<?php echo $i['loginurl']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Captcha on login</label>
                                <select class="form-control" name="settings[captcha]">
                                    <option <?php if($i['captcha'] == "1") { echo 'selected'; 
                                   } ?> value="1">Yes</option>
                                    <option <?php if($i['captcha'] == "0") { echo 'selected'; 
                                   } ?> value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Captcha on registeration</label>
                                <select class="form-control" name="settings[captcha_reg]">
                                    <option <?php if($i['captcha_reg'] == "1") { echo 'selected'; 
                                   } ?> value="1">Yes</option>
                                    <option <?php if($i['captcha_reg'] == "0") { echo 'selected'; 
                                   } ?> value="0">No</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Email <small>This email is the email that sends emails to users</small></label>
                                <input type="text" name="settings[email]" class="form-control" value="<?php echo $i['email']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Paga Mode <small>Payment Mode</small></label>
                                <select class="form-control" name="settings[paga_mode]">
                                    <option <?php if($i['paga_mode'] == "1") { echo 'selected'; 
                                   } ?> value="1">Live</option>
                                    <option <?php if($i['paga_mode'] == "0") { echo 'selected'; 
                                   } ?> value="0">Demo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Public Key <small>Live Public key</small></label>
                                <input type="text" name="settings[paga_live_public_key]" class="form-control" value="<?php echo $i['paga_live_public_key']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Private Key <small>Live Private Key</small></label>
                                <input type="text" name="settings[paga_live_private_key]" class="form-control" value="<?php echo $i['paga_live_private_key']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Public Key <small>Test Public key</small></label>
                                <input type="text" name="settings[paga_test_public_key]" class="form-control" value="<?php echo $i['paga_test_public_key']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Private Key <small>Test Private Key</small></label>
                                <input type="text" name="settings[paga_test_private_key]" class="form-control" value="<?php echo $i['paga_test_private_key']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Email server <small>Current webhost email server [leave blank if unknown]</small></label>
                                <input type="text" name="settings[emailserver]" class="form-control" value="<?php echo $i['emailserver']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Default profile picture</label>
                                <input type="text" name="settings[defaultpic]" class="form-control" value="<?php echo $i['defaultpic']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Welcome email subject</label>
                                <input type="text" name="settings[welcome_title]" class="form-control" value="<?php echo $i['welcome_title']; ?>"></input>
                            </div>
                            <div class="form-group">
                                <label>Welcome email message</label>
                                <textarea type="text" name="settings[welcome_message]" class="form-control"><?php echo $i['welcome_message']; ?></textarea>
                            </div>
                            <div class="form-group">
                                 <input type="submit" style="float:left;"class="btn btn-primary" value="Update settings" name="update_sitesettings">
                            </div>
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
