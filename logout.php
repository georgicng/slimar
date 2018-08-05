<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "logout";


?>
<!DOCTYPE html>
<html>
<head>
<?php require 'inc/themes/user/head.php' ?>
</head>



<body class="game" id="page">
<?php require 'inc/themes/user/header.php' //This will be the navigation ?>

<div style="margin-top:50px"></div>


<div class="slider-control">
<div class="container">
<div style="padding:20px 0px;font-size:15pt">
Logout
</div>
</div>
</div>
</div>


<div class="container">
    <div class="row">
      <div class="col-md-8" style="padding:10px;">
        <div class="contentcontainer">
            <div class="title-blue">You have successfully logged out</div>
    <?php
    activitylog(''.$in['username'].'', 'Logged out', ''.time().'');
    if($in['username']) {
        setcookie("id", '', time() - 3600);
        setcookie("password", '', time() - 3600);
        header("location: index.php");
    }
    ?>
        </div>

      
      
      </div>
    </div>
</div>



<?php require "inc/themes/user/footer.php" //This will be where the footer comes from ?>

</body>
<?php //Scripts for pages will go here ?>
<Script>
 $.each( jQuery('.carousel .item'), function( i, val ) {
    $(this).css('background-image','url('+$(this).find('img').attr('src')+')').css('background-size','cover').find('img').css('visibility','hidden');
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</html>
