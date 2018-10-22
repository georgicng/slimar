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
    $id = $_GET['id'];
} else {
    $error = 'Payment details not supplied';
    header("location: manage_payouts.php?error=".urlencode($error));
}

$stmt1 = $dbh->prepare("SELECT * from payouts WHERE `id` = :id");
$stmt1->bindValue(':id', $id);
$stmt1->execute();
$payout = $stmt1->fetch();
error_log('payment '.json_encode($payout));
$stmt2 = $dbh->prepare("SELECT * from payout_requests WHERE `id` = :id");
$stmt2->bindValue(':id', $payout['request_id']);
$stmt2->execute();
$request = $stmt2->fetch();
error_log('request '.json_encode($request));
if ($request['status'] != 'Approved') {
    $error = 'Payment request has not been approved';
    header("location: manage_requests.php?id=".$payout['request_id']."error=".urlencode($error));
}
    
    //send OTP to paystack
    if (isset($_POST["sendOTP"])) {
        if (!empty($_POST["otp"]) && !empty($payout['reference'])) {
            //wrap in try catch block
            $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];
            $transfer = cSendOTP($key, $payout['reference'], $_POST["otp"]);
            error_log('otp repsonse: '.json_encode($transfer));
            if ($transfer['status']) {
                $success = $transfer['message'];
                header("location: manage_payouts.php?success=".urlencode($success));
            } else {
                $error = $transfer['message'];
                header("location: manage_payouts.php?error=".urlencode($error));
            }
            
        }
        $message = "Missing parameters";
    } elseif (!empty($_GET['retry'])) {
        //retry OTP        
        $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];
        $response = resendOTP($key, $payout['reference']);
        error_log('resend otp repsonse: '.json_encode($response));
        $message = $response['message'];
    } elseif (!empty($payout['recipient']) && $payout['status'] == "Queued") {
        //initaiate payment transfer
        $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];
        error_log('key '.json_encode($key));
        $transfer = cmakeTransfer($key, floatval($payout['amount']) * 100, $payout['recipient']);
        if ($transfer && $transfer['status']) {
            error_log('transfer: '.json_encode($transfer));
            $stmt =  $dbh->prepare("UPDATE payouts SET reference = :reference, data = :data, date_modified = :date_modified, status = :status");
            $reference = $transfer['data']['transfer_code'];
            $stmt->bindParam(':reference', $reference);
            $data = serialize($transfer);
            $stmt->bindParam(':data', $data);
            $status = $transfer['data']['status'];
            $stmt->bindParam(':status', $status);
            $date = date("Y-m-d H:i:s");
            $stmt->bindParam(':date_modified', $date);
            $stmt->execute();
            $message = $transfer['message'];
        } else {
            $error = "Couldn't process request: ".$transfer['message'];
            $response = checkBalance($key);
            if ($response && $response['status']) {
                $balance = $response['data'][0]['currency'].floatval($response['data'][0]['balance'])/100;
                $error.=' ('.$balance.')';
            }
            error_log('error: '.json_encode($error));
            header("location: manage_payouts.php?id=".$payout['id']."&error=".urlencode($error));
        }
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
            <?php if (!empty($message)) {
                ?>
            <div class="alert bg-info" role="alert">
                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> <?php echo $message ?></a>
        </div>
        <?php
            } ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Enter Token</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="otp" placeholder="Enter OTP" class="form-control" required />
                            </div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Authorize Transfer" name="sendOTP">
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
