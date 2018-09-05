<?php
ob_start();
$admin = true;
require '../vendor/autoload.php';
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "make_transfer";
//Sets last active time for forums [This is to check if the user is online or not]

if (!$in_perm['has_admin']) {
    header("location: ../index.php");
    exit;
}

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = "id";
} else {
    $error = 'Payment details not supplied';    
    header("location: ".add_query_vars('manage_requests.php', ['error' => $error]));
}

$stmt1 = $dbh->prepare("SELECT * from payouts WHERE `id` = :id");
$stmt1->bindValue(':id', $id);
$stmt1->execute();
$payout = $stmt1->fetch();

$stmt1 = $dbh->prepare("SELECT * from payout_requests WHERE `id` = :id");
$stmt1->bindValue(':id', $payout['request_id']);
$request = $stmt1->fetch();

if ($request['status'] != 'Approved') {
    $error = 'Payment request has not been approved';    
    header("location: ".add_query_vars('manage_requests.php', ['error' => $error]));
} 

try
{  
    //initaiate payment transfer
    $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key']; 
    if (empty($payout['reference'])) {
        $transfer = makeTransfer($key, $payout['amount'] * 100, $payout['recipient']);
        $stmt =  $dbh->prepare("UPDATE payouts SET reference = :reference, data = :data, date_modified = :date_modified, status = :status");
        $stmt->bindParam(':reference', $transfer->data->transfer_code);
        $stmt->bindParam(':data', serialize($transfer->data));
        $stmt->bindParam(':status', $transfer->data->status);
        $stmt->bindParam(':date_modified', date("Y-m-d H:i:s"));                
        $stmt->execute();
    }

    //retry OTP
    if (!empty($_GET['retry'])) {
        //wrap in try catch block
        resendOTP($key, $payout['reference']);
    } 

    //send OTP to paystack
    if (isset($_POST["sendOTP"]) && !empty($_POST["otp"]) && !empty($payout['reference'])) {
        //wrap in try catch block
        $transfer = sendOTP($key, $payout['reference'], $_POST["otp"]);
        $success = 'OTP sent successfully, transaction finalized';    
        header("location: ".add_query_vars('manage_requests.php', ['success' => $success]));
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
                <li><a href="manage_requests.php"> Request</a></li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Enter Token</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="otp" placeholder="Enter OTP" class="form-control" required />
                            </div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Authorize Transfer" name="addOTP">
                        </form>
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
<?php
} catch(\Yabacon\Paystack\Exception\ApiException $e){
    $error = $e->getMessage();
    header("location: ".add_query_vars('manage_payouts.php', ['id' => $payout['id'], 'error' => $error]));
}

?>

