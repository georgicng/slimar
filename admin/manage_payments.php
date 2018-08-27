<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_payments";
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
                <li><a href="manage_payments.php"> Manage Payments</a></li>
            </ol>
        </div><!--/.row-->
        <br>
    <?php if ($_GET['success'] == "user") {
    ?>
        <div class="alert bg-success" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Payment successfully updated</a>
        </div>
    <?php
} ?>
        
    <?php if ($page == "home") {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new payment</div>
                    <div class="panel-body">
        <?php
        //Post comment
        if (isset($_POST["addpayment"])) {
            if ($in["username"]) {
                $userId = $_POST['payment_userId'];
                $amount= $_POST['payment_amount'];
                $reference = $_POST['payment_reference'];
                $date = date("Y-m-d H:i:s");
                $comment = $_POST['payment_comment'];
                            
                            
                activitylog(''.$in['username'].'', 'added a new payment', ''.time().'');
                $stmt = $dbh->prepare("INSERT INTO payments (userid, amount, reference, date, comment) VALUES (:userid, :amount, :reference, :date, :coment)");
                $stmt->bindParam(':userid', $userid);
                $stmt->bindParam(':amount', $amount);
                $stmt->bindParam(':reference', $reference);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':comment', $comment);
                            
                $stmt->execute();
            }
        } ?>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="payment_userid" placeholder="User ID" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <input type="number" name="payment_amount" placeholder="Amount" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <input type="text" name="payment_reference" placeholder="Payment reference code" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <textarea name="payment_comment" placeholder="Enter comment" class="form-control"></textarea>
                            </div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Add payment" name="addpayment">
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Payments</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>View</th>
                            </tr>
                            </thead>
        <?php
        $sql = "SELECT p.*, u.username FROM payments as p join users as u on p.userid = u.id ORDER BY date desc";
        $stm = $dbh->prepare($sql);
        $stm->execute();
        $payments = $stm->fetchAll();
                            
        $count = 0;
        foreach ($payments as $payment) {
            ?>
                            <tr>
                                <td><?php echo $payment['username']; ?></td>
                                <td><?php echo $payment['amount']; ?></td>                                
                                <td><?php echo $payment['reference']; ?></td>                                
                                <td>
                                    <a href='manage_payments.php?p=view&id=<?php echo $payment['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> View</a> 
                                    <a href='manage_payments.php?p=reverse&id=<?php echo $payment['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Reverse</a> </td>
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
        $stmt1 = $dbh->prepare("SELECT * from payments WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $payment = $stmt1->fetch();
        error_log("payment: ".json_encode($payment));
            
        if (isset($_POST['updatepayment'])) {
            error_log("In: ".json_encode($_POST));
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'commented on payment '.$payment['id'].'', ''.time().'', 'Admin');
                    
            $update_query = $dbh->prepare("UPDATE payments SET comment='".$_POST['comment']."' WHERE id='".$_GET['id']."'");
            $update_query->execute();
            $success = "Payment updated";
            header("location: manage_payments.php");
        } ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">View Payment: <?php echo $payment['reference']; ?></div>
                    <div class="panel-body">
                    
                        <form method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo $payment['userid']; ?>" class="form-control" readonly></input>
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
                                <label>Comment</label>
                                <textarea name="comment" placeholder="Enter comment" class="form-control"><?php echo $payment['comment']; ?></textarea>
                            </div>
                             <input type="submit" style="float:left;"class="btn btn-primary" value="Update category" name="updatepayment">
                        </form>
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
            activitylog(''.$in['username'].'', 'revered payment: '.$payment['id'].'', ''.time().'', 'Admin');
            $update_query = $dbh->prepare("UPDATE payments SET contra = '1' WHERE id='".$_GET['id']."'");
            $update_query->execute();
            $balance = $payment['balance'] - $payment['amount'];
            $update_query = $dbh->prepare("UPDATE users SET balance = '".$balance."' WHERE id='".$payment['userid']."'");
            $update_query->execute();
            header("location: manage_payments.php");
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
                            <a class="btn btn-primary" href="manage_payments.php">Cancel</a>
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
