<?php
ob_start();
$admin = true;
require '../vendor/autoload.php';
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_payouts";
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
<link href="css/easy-autocomplete.min.css" rel="stylesheet">
<link href="css/easy-autocomplete.themes.min.css" rel="stylesheet">
</head>

<body>
    <?php require "inc/header.php"; ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">            
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                <li><a href="manage_payouts.php"> Manage Payouts</a></li>
            </ol>
        </div><!--/.row-->
        <br>
    <?php if (isset($_GET['success'])) {
    ?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> <?php echo $_GET['success'] ?></a>
        </div>
    <?php
} elseif (isset($_GET['error'])) {
        ?>
        <div class="alert bg-error" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> <?php echo $_GET['error'] ?></a>
        </div>
    <?php
    }  ?>
        
    <?php if ($page == "home") {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Payouts</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Reference</th>
                                <th>View</th>
                            </tr>
                            </thead>
        <?php
        $sql = "SELECT p.*, (select username from users u where u.id = p.user_id) as username FROM payouts as p ORDER BY p.date_added desc";
        $stm = $dbh->prepare($sql);
        $stm->execute();
        $payments = $stm->fetchAll();
        // error_log("payments ".json_encode($payments));                 
        $count = 0;
        foreach ($payments as $payment) {
            ?>
                            <tr>
                                <td><?php echo $payment['id']; ?></td>
                                <td><?php echo $payment['username']; ?></td>
                                <td><?php echo $payment['amount']; ?></td>
                                <td><?php echo $payment['status']; ?></td>                                 
                                <td><?php echo $payment['reference']; ?></td>                                
                                <td>
                                    <a href='manage_payouts.php?p=view&id=<?php echo $payment['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> View</a>
                                    <?php if ($payment['status'] == "Complete") { ?> 
                                        <a href='manage_payouts.php?p=reverse&id=<?php echo $payment['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Reverse</a> </td>
                                    <?php } elseif ($payment['status'] == "otp") { ?> 
                                        <a href="<?php echo 'make_transfer.php?id='.$payment['id'].'&retry=1'; ?>" class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Resend Token</a> </td>
                                    <?php } else { ?>
                                        <a href='make_transfer.php?id=<?php echo $payment['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Process</a> </td> 
                                    <?php } ?>
                            </tr>
        <?php
        } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php
    } ?>

    <?php if ($page == "view") {
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * from payouts WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $payment = $stmt1->fetch(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">View Payout: <?php echo $payment['id']; ?></div>
                    <div class="panel-body">
                        <?php if (isset($_GET['error']) && empty($payment['reference'])) {
            ?>
                            <a href="<?php echo 'make_transfer.php?id='.$payment['id'] ?>" class='btn btn-primary btn-xs'>
                                <i class='fa fa-pencil-square-o' aria-hidden='true'></i> Retry Transaction
                            </a>
                        <?php
        } elseif (isset($_GET['error']) && !empty($payment['reference'])) {
            ?>
                            <a href="<?php echo 'make_transfer.php?id='.$payment['id'].'&retry='.true ?>"" class='btn btn-primary btn-xs'>
                                <i class='fa fa-pencil-square-o' aria-hidden='true'></i> Resend token
                            </a>
                       <?php
        } else {
            ?>
                        <form method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo $payment['userid']; ?>" class="form-control" readonly></input>
                                <input type="hidden" name="userid" value="<?php echo $payment['userid']; ?>">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" name="amount" value="<?php echo $payment['amount']; ?>" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label>Reference</label>
                                <input type="text" name="reference" value="<?php echo $payment['reference']; ?>" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label>Request</label>
                                <input type="type" class="form-control" value="<?php echo $payment['request_id']; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="type" class="form-control" value="<?php echo $payment['status']; ?>" />
                            </div>
                            <a href='manage_payouts.php' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Back</a>
                        </form>
                       <?php
        } ?> 
                    </div>
                </div>
            </div>
        </div><!--/.row-->

    <?php
    } ?>
    <?php if ($page == "reverse") {
        //Gathers users
        $stmt1 = $dbh->prepare("SELECT * FROM payments WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $payment = $stmt1->fetch();
            
        if ($_POST['reversepayment']) {
            //TODO: prevent reversal if user is online and playing a game
            activitylog(''.$in['username'].'', 'reverted payment transfer: '.$payment['id'].'', ''.time().'', 'Admin');
            $update_query = $dbh->prepare("UPDATE payouts SET contra = '1' WHERE id='".$_GET['id']."'");
            $update_query->execute();
            $balance = $payment['balance'] - $payment['amount'];
            $update_query = $dbh->prepare("UPDATE users SET balance = '".$balance."' WHERE id='".$payment['userid']."'");
            $update_query->execute();
            header("location: manage_payouts.php");
        } ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Reverse payment of <?php echo $payment['amount']; ?> by <?php echo $payment['userid']; ?> </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="viewprofile">Are you sure you would like to reverse this transaction? This can not be undone!!<br />
                    
                                </label>
                            </div>
                            <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Reverse" name="reversepayment"> 
                            <a class="btn btn-primary" href="manage_payouts.php">Cancel</a>
                        </form>    
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php
    } ?>
        
    </div>    <!--/.main-->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/jquery.easy-autocomplete.min.js"></script>
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

        var options = {
            url: "tables/data4.php",
            getValue: function(element) {
                return element.name;
            },
            list: {
                onChooseEvent: function() {
                    var value = $("#payment_username").getSelectedItemData().id;
                    $("#payment_userid").val(value);
                },
                onSelectItemEvent: function() {
                    var value = $("#payment_username").getSelectedItemData().id;
                    $("#payment_userid").val(value);
                }
            }       
        };

        $("#payment_username").easyAutocomplete(options);
    </script>    
</body>

</html>
