<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "activitylog";
//Sets last active time for forums [This is to check if the user is online or not]

if(!$in_perm['has_admin']) {
    header("location: ../index.php");
    exit;
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
                <li><a href="activitylog.php"> Activity Log</a></li>
            </ol>
        </div><!--/.row-->
        <br>
    <?php if($_GET['success'] == "user") {?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> User's profile successfully updated</a>
        </div>
    <?php } ?>
    <?php if($_GET['success'] == "password") {?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> User's password successfully updated</a>
        </div>
    <?php } ?>
    <?php if($_GET['success'] == "profilepic") {?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> User's profile picture successfully updated</a>
        </div>
    <?php } ?>
        
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">View activity log</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-url="tables/data2.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                            <thead>
                            <tr>
                        
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="username"  data-sortable="true">Username</th>
                                <th data-field="ip" data-sortable="true">IP Address</th>
                                <th data-field="message" data-sortable="true">Message</th>
                                <th data-field="time" data-sortable="true">Time</th>
                                <th data-field="other" data-sortable="true">Type</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        

        
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
