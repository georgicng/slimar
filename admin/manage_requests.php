<?php
ob_start();
$admin = true;
require '../vendor/autoload.php';
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_requests";
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
                <li><a href="manage_requests.php"> Manage Payment Requests</a></li>
            </ol>
        </div><!--/.row-->
        <br>
    <?php if (isset($_GET['success'])) {
    ?>
        <div class="alert bg-success" role="alert">
            <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> <?php echo $_GET['success']; ?>
        </div>
    <?php
} elseif (isset($_GET['error'])) {
        ?>
            <div class="alert bg-error" role="alert">
                <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> <?php echo $_GET['error']; ?>
            </div>
        <?php
    } ?>
        
    <?php if ($page == "home") {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new payment request</div>
                    <div class="panel-body">
        <?php
        
        $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key']; 
        $banks = getBankList($key);
        //Post comment
        if (isset($_POST["addrequest"])) {
            if ($in["username"]) {
                $user_id = $_POST['request_userid'];
                $amount= $_POST['request_amount'];
                $bank = $_POST['request_bank'];
                $account_number = $_POST['request_account-number'];
                $account_name = $_POST['request_account-name'];
                $account_type = $_POST['request_account-type'];
                $status = 'Pending';
                $date = date("Y-m-d H:i:s");
                $comment = $_POST['request_comment'];
                            
                //Todo validation and balance check
                $sql = "SELECT * FROM users WHERE id = ".$user_id;
                $stm = $dbh->prepare($sql);
                $stm->execute();
                $user = $stm->fetch();

                if ($amount < $user['balance']) {
                    //set holding balance
                    $holding = $amount;
                    $balance = $user['balance'] - $amount;
                    $stmt =  $dbh->prepare("UPDATE users SET balance = :balance, holding = :holding WHERE id = ".$user_id);
                    $stmt->bindParam(':holding', $holding);
                    $stmt->bindParam(':balance', $balance);
                    $stmt->execute();
                    
                    //send email
                    $subject = "Transfer request";
                    $message = "Your transfer request has been submitted successfully and waiting for approval.".
                        "You will be updated on the status of your request shortly";
                    mailer($i, $user['email'], $subject, $message);

                    activitylog(''.$in['username'].'', 'added a new payment request', ''.time().'');
                    $stmt =  $dbh->prepare("INSERT INTO payout_requests (user_id, bank, account_name, account_number, account_type, amount, date_added, status) VALUES (:user_id, :bank, :account_name, :account_number, :account_type, :amount, :date_added, :status)");
                    $stmt->bindParam(':amount', $amount);
                    $stmt->bindParam(':bank', $bank);
                    $stmt->bindParam(':account_name', $account_name);
                    $stmt->bindParam(':account_number', $account_number);
                    $stmt->bindParam(':account_type', $account_type);
                    $stmt->bindParam(':status', $status);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':date_added', $date);
                    $stmt->bindParam(':comment', $comment);

                    //get recipient detail for transfer
                    $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];
                    if ($recipient = getRecipient($key, $account_name, $bank, $account_number)) {
                        $stmt =  $dbh->prepare("UPDATE payout_requests SET recipient = :recipient, data = :data, error = :error WHERE id = ".$user_id);
                        $stmt->bindParam(':recipient', $recipient['recipient_code']);
                        $stmt->bindParam(':error', '');
                        $stmt->bindParam(':data', serialize($recipient));
                        $stmt->execute();
                    } else {
                        $stmt =  $dbh->prepare("UPDATE payout_requests SET recipient = :recipient, data = :data, error = :error WHERE id = ".$user_id);
                        $stmt->bindParam(':recipient', false);
                        $stmt->bindParam(':error', '');
                        $stmt->bindParam(':data', serialize($recipient));
                        $stmt->execute();
                    }
                }
                
                
            }
        } ?>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="request_username" placeholder="User Name" id="request_username" class="form-control"></input>
                                <input type="hidden" name="request_userid" id="request_userid">
                            </div>
                            <div class="form-group">
                                <input type="number" name="request_amount" placeholder="Amount" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <select name="request_bank" class="form-control">
                                    <option value="">Select Bank</option>
                                    <?php foreach ($banks as $bank) { ?>
                                        <option value="<?php echo $bank['id'] ?>"><?php echo $bank['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="request_account-number" placeholder="Enter account number" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <input type="text" name="request_account-name" placeholder="Enter account name" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="type">Account Type</label>
                                <select name="request_account-type" id="account_type" class="form-control">
                                    <option value="">Select account type</option>
                                    <option value="current">Current</option>
                                    <option value="savings">Savings</option>
                                </select>                                           
                            </div>
                            <div class="form-group">
                                <textarea name="request_comment" placeholder="Enter comment" class="form-control"></textarea>
                            </div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Add request" name="addrequest">
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Payment Requests</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                            </thead>
        <?php
        $sql = "SELECT p.*, u.username FROM payout_requests as p join users as u on p.user_id = u.id ORDER BY date_added desc";
        $stm = $dbh->prepare($sql);
        $stm->execute();
        $requests = $stm->fetchAll();
                            
        $count = 0;
        foreach ($requests as $request) {
            ?>
                            <tr>
                                <td><?php echo $request['id']; ?></td>
                                <td><?php echo $request['username']; ?></td>
                                <td><?php echo $request['amount']; ?></td>                                
                                <td><?php echo $request['status']; ?></td>                                
                                <td>
                                    <a href='manage_requests.php?p=view&id=<?php echo $request['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> View</a> 
                                    <a href='manage_requests.php?p=delete&id=<?php echo $request['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> 
                                </td>
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
        $stmt1 = $dbh->prepare("SELECT *, (select username from users where id = :id) as username from payout_requests WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $request = $stmt1->fetch();
            
        if (isset($_POST['approverequest'])) {
            if ($_POST['comment']) {
                $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            } else {
                $comment = '';
            }
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'approved payment request'.$request['id'].'', ''.time().'', 'Admin');
            
            //update request
            $update_query = $dbh->prepare("UPDATE payout_requests SET status='Approved', comment='".$comment."', date_modified ='".date("Y-m-d H:i:s")."' WHERE id='".$_GET['id']."'");
            $update_query->execute();
            
            //create payout request for processing
            $stmt =  $dbh->prepare("INSERT INTO payouts (user_id, request_id, recipient, amount, date_added, status) VALUES (:user_id, :request, :recipient, :amount, :date_added, :status)");
            $stmt->bindParam(':amount', $request['amount']);
            $stmt->bindParam(':request', $request['id']);
            $stmt->bindParam(':recipient', $request['recipient']);
            $status = 'Queued';
            $stmt->bindParam(':status', $status);            
            $user_id = $_POST['userid'];
            $stmt->bindParam(':user_id', $user_id);
            $date = date("Y-m-d H:i:s");
            $stmt->bindParam(':date_added', $date);
            if ($stmt->execute()) {
                header("location: make_transfer.php?id=".$dbh->lastInsertId());
            }
            error_log(json_encode($stmt->errorInfo()));
            
        } elseif (isset($_POST['rejectrequest'])) {
            if ($_POST['comment']) {
                $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            } else {
                $comment = '';
            }
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            $user_id = $_POST['userid'];
            activitylog(''.$in['username'].'', 'rejected payment request'.$request['id'].'', ''.time().'', 'Admin');
            
            //update request status
            $update_query = $dbh->prepare("UPDATE payout_requests SET status='Rejected', comment='".$comment."', date_modified ='".date("Y-m-d H:i:s")."' WHERE id='".$_GET['id']."'");
            if ($update_query->execute()) {
                $sql = "SELECT * FROM users WHERE id = ".$user_id;
                $stm = $dbh->prepare($sql);
                $stm->execute();
                $user = $stm->fetch();
                
                //restore user balance
                $holding = 0;
                $balance = $user['balance'] + $user['holding'];
                $request = null;
                $stmt =  $dbh->prepare("UPDATE users SET balance = :balance, holding = :holding , request = :request WHERE id = ".$user_id);
                $stmt->bindParam(':holding', $holding);
                $stmt->bindParam(':balance', $balance);
                $stmt->bindParam(':request', $request);
                $stmt->execute();
                //send email
                $subject = "Transfer request Rejected";
                $message = "We are sorry to inform you that your transfer request has been rejected due to the following reason:".$comment;
                mailer($i, $user['email'], $subject, $message);
                
                $success = "Payment request status updated";
                header("location: ".add_query_vars('manage_requests.php', ['success' => $success]));
            }
           
        } ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">View Payment Request: <?php echo $request['id']; ?></div>
                    <div class="panel-body">
                    
                        <form method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo $request['username']; ?>" class="form-control" readonly></input>
                                <input type="hidden" name="userid" value="<?php echo $request['user_id']; ?>">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" name="amount" value="<?php echo $request['amount']; ?>" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label>bank</label>
                                <input type="text" name="bank" value="<?php echo $request['bank']; ?>" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" name="bank" value="<?php echo $request['account_name']; ?>" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" name="bank" value="<?php echo $request['account_number']; ?>" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label>Account Type</label>
                                <input type="text" name="bank" value="<?php echo $request['account_type']; ?>" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea name="comment" placeholder="Enter comment" class="form-control" required><?php echo $request['comment']; ?></textarea>
                            </div>
                             <input type="submit" style="float:left;"class="btn btn-primary" value="Approve payment" name="approverequest">
                             <input type="submit" style="float:left;"class="btn btn-secondary" value="Reject payment" name="rejectrequest">
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->

    <?php
    } ?>
    <?php if ($page == "delete") {
        //Gathers users
        $stmt1 = $dbh->prepare("SELECT * FROM payout_requests WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $request = $stmt1->fetch();
            
        if ($_POST['deleterequest'] && $request['status'] != "Pending") {
            //TODO: prevent reversal if user is online and playing a game
            activitylog(''.$in['username'].'', 'deleted payment request: '.$request['id'].'', ''.time().'', 'Admin');
            $update_query = $dbh->prepare("DELETE payout_requests WHERE id='".$_GET['id']."'");
            if ($update_query->execute()) {
                $success = "Payment request deleted succesfully";
                header("location: ".add_query_vars('manage_requests.php', ['success' => $success]));
            }

        } else {
            $error = 'Pending Requests cannot be deleted';
            header("location: ".add_query_vars('manage_requests.php', ['error' => $error]));
        } ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete payment request of <?php echo $request['amount']; ?> by <?php echo $request['userid']; ?> </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="viewprofile">Are you sure you would like to delete this request? This can not be undone!!<br />
                    
                                </label>
                            </div>
                            <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Reverse" name="deleterequest"> 
                            <a class="btn btn-primary" href="manage_requests.php">Cancel</a>
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
                    var value = $("#request_username").getSelectedItemData().id;
                    $("#prequest_userid").val(value);
                },
                onSelectItemEvent: function() {
                    var value = $("#request_username").getSelectedItemData().id;
                    $("#request_userid").val(value);
                }
            }       
        };

        $("#request_username").easyAutocomplete(options);
    </script>    
</body>

</html>
