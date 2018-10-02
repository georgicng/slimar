<?php
use Siler\Twig;
// [* SlimarUSER *] set user cookie//
if (isset($_COOKIE['id'])) {  //Main class to set valuables across website
    $id = $_COOKIE['id'];

    $stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->bindValue(':id', $_COOKIE['id']);
    $stmt->execute();
    $rowuser = $stmt->fetch();

    if ($stmt->rowCount()  < 1) {
        setcookie("id", '', time() - 3600);
        setcookie("password", '', time() - 3600);
    } else {
        if ($rowuser['password'] == $_COOKIE['password']) {
            if ($rowuser['banned'] == "0") {
                //Gathers users
                $stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id");
                $stmt->bindValue(':id', $_COOKIE['id']);
                $stmt->execute();
                $in = $stmt->fetch();
            
                //Gathers users permissions
                $stmt1 = $dbh->prepare(
                    "SELECT * FROM usergroups WHERE `rank` = :id"
                );
                $stmt1->bindValue(':id', $in['usergroup']);
                $stmt1->execute();
                $in_perm = $stmt1->fetch();

                //set initial balance
                if (empty($in['balance'])) {
                    $in['balance'] = 0;
                }
            
                //Gets user profile picture
                if (if_gravatar("".$in['email']."") == "true" 
                    && $in['gravatar'] == "1"
                ) {
                    $profilepic = get_gravatar($in['email']);
                } else {
                    $profilepic = $in['profilepic'];
                }
            } else {
                $error = 'This account is currently banned!';
                setcookie("id", '', time() - 3600);
                setcookie("password", '', time() - 3600);
            }
        } else {
            setcookie("id", '', time() - 3600);
            setcookie("password", '', time() - 3600);
        }
    }
}

//process login
session_start();
if (isset($_POST['login'])) {
    if (!isset($in["username"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `email` = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        
        if (!$i['captcha'] == "1" || isset($_POST["captcha"])
            && $_POST["captcha"] != "" && $_SESSION["code"] == $_POST["captcha"]
        ) {
            if ($stmt->rowCount()  < 1) {
                $error = "The email you have entered does not exist";
            } else {
                $hashedpassword = $row['password'];
            
                if (password_verify($password, $hashedpassword)) {
                    //correct password
                    //Activity log
                    activitylog(''.$row ['username'].'', 'Logged in', ''.time().'');
                    if (isset($_POST['remember'])) { 
                        //sets cookie
                        setcookie("id", $row["id"], time()+(60*60*60*24*5));
                        setcookie("password", $row["password"], time()+(60*60*60*24*5));
                        header("location: ".$i['loginurl']."");
                    } else {
                        //sets session 
                        setcookie("id", $row["id"], time()+3600);
                        setcookie("password", $row["password"], time()+3600);
                        header("location: ".$i['loginurl']."");
                    }
                } else {
                    $error = "The password you have entered is wrong.";
                }
            }
        } else {
            $error = "The captcha you entered is wrong";
        }
    } else {
    }
}

//process registration
if (isset($_POST['register'])) {
    if (!isset($in["username"])) {
        error_log('processing registration');
        error_log("post: ".json_encode($_POST));
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
        $refer = filter_var($_POST['refer'], FILTER_SANITIZE_STRING);
        
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $rowusername = $stmt->fetch();
        
        if (isset($refer)) {
            $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username");
            $stmt->bindValue(':username', $refer);
            $stmt->execute();
            $getuserid = $stmt->fetch();
            
            if (isset($getuserid['id'])) {
                $userreferred = $getuserid['id'];
            } else {
                $userreferred = '0';
            }
        } else {
            $userreferred = '0';
        }
        
        
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `email` = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $rowemail = $stmt->fetch();
        
        
        if ($rowusername['username']) {
            $error[] = "The username that you have entered already exists! Try logging in <a href='login.php'>here</a>";
        } 
        
        if ($rowemail['email']) {
            $error[] = "The email that you have entered already exists! Try logging in <a href='login.php'>here</a>";
        }
        
        if ($password != $password2) {
            $error[] = "The two passwords you entered do not match";
        }

        if ($i['captcha_reg'] == "1") {
          if (empty($_POST["captcha"]) || $_SESSION["code"] != $_POST["captcha"]) {
              $error[] = "The captcha you entered is incorrect";
          }
        }

        if (empty($_POST["tos"]) || $_POST["tos"] != "1") {
            $error[] = "You are required to accept to our terms of service";
        }
                
        if (empty($error)) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $profilepic = $i['defaultpic'];
            error_log('password hash: '.$password_hashed);
        
            $stmt = $dbh->prepare("SELECT * FROM users ORDER BY id desc LIMIT 1");
            $stmt->execute();
            $getlastid = $stmt->fetch();
            $lastid = $getlastid['id'] + 1;
            error_log('register id: '.$lastid);
        
            $joindate = time();
            $join_month = date("F", strtotime("first day of this month"));
            try {
                $sql = "INSERT INTO users (username, password, email, firstname, balance, profilepic, joindate, join_month, verified, verified_rand, referral) ".
                    " VALUES (:username, :password, :email, :firstname, :balance, :profilepic, :joindate, :join_month, :verified, :verified_rand, :referral)";
                $stmt = $dbh->prepare($sql);
                $verified_rand  = uniqid();
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password_hashed);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':balance', $i['bonus']);
                $stmt->bindParam(':profilepic', $profilepic);
                $stmt->bindParam(':joindate', $joindate);
                $stmt->bindParam(':join_month', $join_month);
                if ($i['verify'] == "0") {
                    $verified = "1";
                    $stmt->bindParam(':verified', $verified);
                } else {
                    $verified = "0";
                    $stmt->bindParam(':verified', $verified);
                }
                $stmt->bindParam(':verified_rand', $verified_rand);                 
                $stmt->bindParam(':referral', $userreferred);
                if ($stmt->execute()) {
                    activitylog(''.$username.'', 'Registered', ''.time().'');
                    //send email
                    include "EmailTemplate.php";
                    $mail = new EmailTemplate(Twig\init(SITE_ROOT.'/views', SITE_ROOT.'/views/cache'));
                    $mailer = $mail->getMessage(
                        'registration', 
                        [
                            "name" => $firstname,
                            "username" => $username,
                            "email" => $email,
                            "link" => $i['url']."/verify.php?id=".$verified_rand,
                            "title" => "New Registration"
                        ]
                    );
                    $mailer->isSMTP();  // Set mailer to use SMTP
                    $mailer->Host = 'localhost';  // Specify main and backup SMTP servers
                    //$mail->SMTPAuth = true;                               // Enable SMTP authentication
                    //$mail->Username = 'user@example.com';                 // SMTP username
                    //$mail->Password = 'secret';                           // SMTP password
                    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    //$mail->Port = 587;                                    // TCP port to connect to

                    $mailer->setFrom($i['email'], 'Chapgames');
                    $mailer->addAddress($email, $firstname);     // Add a recipient
                    $mailer->send();
                    //sets session 
                    setcookie("id", $dbh->lastInsertId(), time()+3600);
                    setcookie("password", $password_hashed, time()+3600);
                    header("location: ".$i['loginurl']."");
                } else {
                    error_log("insert error data: ".json_encode($stmt->errorInfo()));
                    $error = $stmt->errorCode().": Opps something went wrong, please try again";
                }                  

            } catch(PDOException $e) {
                $error = $e->getMessage();
            }                   
            
        }
    }
}


//Sets last active time for online users
if (isset($in['id'])) {
    $currenttime = time();
    if ($in['lastactive'] < $currenttime) {
        $sql = $dbh->prepare("UPDATE users SET lastactive='".$currenttime."' WHERE id=".$in['id']."");
        $sql->execute();
    }
}
 
//Private messaging
if (isset($_POST['sendmessage'])) {
    if (!empty($in["username"])) {
        $id_from = "1";
        $id_to = $_POST['userid'];
        $subject = strip_tags($_POST['subject'], '<br><b><strong>');
        $message = strip_tags($_POST['message'], '<br><b><strong>');
        $date = $_POST['date'];
        $currenttime = time();
        $sub_id = $_POST['postid'];
        $sub = "1";
        
        if ($in['id'] != $id_from) {
            echo 'oh no theres an error!';
            activitylog(''.$in['username'].'', 'SECURITY ERROR: USER TRYING TO SEND MESSAGE AS DIFFERENT USER', ''.time().'');
        } else {
            activitylog(''.$in['username'].'', 'sent a private message', ''.time().'');
            $stmt = $dbh->prepare("INSERT INTO users_inbox (id_to, id_from, message, subject, date) VALUES (:id_to, :id_from, :message, :subject, :date)");
            $stmt->bindParam(':id_to', $id_to);
            $stmt->bindParam(':id_from', $in['id']);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':date', $currenttime);
            $stmt->execute();
            $success = "Message successfully sent";
        }
    }
}
 
//Upload avatar
if (isset($_POST["uploadavatar"])) {
    $currenturl = $i['url'];

    $target_dir = "files/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $new_name = $location.time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload"]["name"];
    $target_file2 = $target_dir . basename($new_name);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1500000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" 
        && $imageFileType != "png" 
        && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error = "Sorry, your profile picture was not uploaded, try again, or try a different picture!";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file2)) {
            $currenturl = $i['url'];
    
    
            activitylog(''.$in['username'].'', 'updated their avatar', ''.time().'');
            $sql = $dbh->prepare("UPDATE users SET profilepic='".$currenturl."/files/uploads/".$new_name."', gravatar='0' WHERE id=".$in['id']."");
            $sql->execute();
            $success = "".$currenturl."/".$new_name."";
            header("location: ".$currenturl."/account_settings.php");
        } else {
            $error = "Sorry, there was an error uploading your profile picture";
        }
    }
}

//Enabling gravatar
if (isset($_POST['enablegravatar'])) {
    if (!empty($in["username"])) {
        if ($_POST['usegravatar'] == "1") {
            $currenturl = $i['url'];
            activitylog(''.$in['username'].'', 'updated their avatar', ''.time().'');
            $sql = $dbh->prepare("UPDATE users SET gravatar='1' WHERE id=".$in['id']."");
            $sql->execute();
            $success = "Gravatar activated";
            header("location: ".$currenturl."/account_settings.php");
        } else {
            $currenturl = $i['url'];
            activitylog(''.$in['username'].'', 'updated their avatar', ''.time().'');
            $sql = $dbh->prepare("UPDATE users SET gravatar='0' WHERE id=".$in['id']."");
            $sql->execute();
            $success = "Gravatar disabled";
            header("location: ".$currenturl."/account_settings.php");
        }
    }
}
 
//Update about
if (isset($_POST['updateabout'])) {
    if (!empty($in["username"])) {
        activitylog(''.$in['username'].'', 'updated their profile', ''.time().'');
        $currenturl = $i['url'];
        $sql = $dbh->prepare("UPDATE users SET aboutme='".$_POST['aboutme']."', gender='".$_POST['gender']."' WHERE id=".$in['id']."");
        $sql->execute();
        $success = "Profile updated";
        header("location: ".$currenturl."/account_settings.php");
    }
}
 
//Update settings
if (isset($_POST['updatesettings'])) {
    if (!empty($in["username"])) {
        $currenturl = $i['url'];
        activitylog(''.$in['username'].'', 'updated their profile', ''.time().'');
        $sql = $dbh->prepare("UPDATE users SET email='".$_POST['email']."', firstname='".$_POST['firstname']."', country='".$_POST['country']."', timezone='".$_POST['timezone']."', dob='".$_POST['dob']."', hide_offline='".$_POST['hide_offline']."', viewprofile='".$_POST['viewprofile']."' WHERE id=".$in['id']."");
        $sql->execute();
        $success = "Account updated";
        header("location: ".$currenturl."/account_settings.php");
    }
}
 
//Update password
if (isset($_POST['updatepassword'])) {
    if (!empty($in["username"])) {
        $currentpassword = "".$_POST['currentpassword']."";
        $newpassword = "".$_POST['newpassword']."";
        $confirmpassword = "".$_POST['confirmpassword']."";
        $currenturl = $i['url'];
            
        if ($newpassword == $confirmpassword) {
            $stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = '".$in['id']."'");
            $stmt->execute();
            $row = $stmt->fetch();
                
            $hashedpassword = $row['password'];
            
            if (password_verify($currentpassword, $hashedpassword)) {
                $password_hashed = password_hash($newpassword, PASSWORD_DEFAULT);
                activitylog(''.$in['username'].'', 'updated their password', ''.time().'');
                $sql = $dbh->prepare("UPDATE users SET password='".$password_hashed."' WHERE id=".$in['id']."");
                $sql->execute();
                $success = "Your password has been updated";
                setcookie("password", $password_hashed, time()+3600);
            } else {
                $error = "Your current password is incorrect";
            }
        } else {
            $error = "The two passwords you have entered are not the same";
        }
    }
}

//Process Payout
if (isset($_POST['payout'])) {
    if (!empty($in["username"])) {
        $error = [];
        $bank = filter_var($_POST['bank'], FILTER_SANITIZE_NUMBER_INT);
        $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT);
        $account_number = filter_var($_POST['account_number'], FILTER_SANITIZE_NUMBER_INT);
        $account_name = filter_var($_POST['account_name'], FILTER_SANITIZE_STRING);
        $account_type = filter_var($_POST['account_type'], FILTER_SANITIZE_STRING);

        if (empty($amount)) {
            $error[] = "amount cannot be empty";
        }

        if ($amount > $in['balance']) {
            $error[] = "you cannot withdraw more than what you have in your account";
        }

        if (empty($bank)) {
            $error[] = "Please select a Bank";
        }

        if (empty($account_name)) {
            $error[] = "Account name cannot be empty";
        }

        if (empty($account_number)) {
            $error[] = "account number cannot be empty";
        }

        if (empty($account_type)) {
            $error[] = "Please select an Account type";
        }
            
            
        if (empty($error)) {
            activitylog(''.$in['username'].'', 'created a payment request', ''.time().'');
            $stmt =  $dbh->prepare(
                "INSERT INTO payout_requests (user_id, bank, account_name, account_number, account_type, amount, date_added, status) VALUES (:user_id, :bank, :account_name, :account_number, :account_type, :amount, :date_added, :status)"
            );
            $status = 'Pending';
            $now = date("Y-m-d H:i:s");
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':bank', $bank);
            $stmt->bindParam(':account_name', $account_name);
            $stmt->bindParam(':account_number', $account_number);
            $stmt->bindParam(':account_type', $account_type);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':user_id', $in["id"]);
            $stmt->bindParam(':date_added', $now);
            if ($stmt->execute()) {
                $id = $dbh->lastInsertId();
                error_log("last id ".$id);
                
                //set holding balance
                $holding = $amount;
                $balance = $in['balance'] - $amount;
                $stmt =  $dbh->prepare("UPDATE users SET balance = :balance, holding = :holding, request = :request WHERE id = ".$in['id']);
                $stmt->bindParam(':holding', $holding);
                $stmt->bindParam(':balance', $balance);
                $stmt->bindParam(':request', $id);
                $stmt->execute();
                
                //send email
                $subject = "Transfer request";
                $message = "Your transfer request has been submitted successfully and waiting for approval. /r/n".
                    "You will be updated on the status of your request shortly";
                mailer($i, $in['email'], $subject, $message);

                //get recipient detail for transfer
                try {
                    $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];
                    $recipient = getRecipient($key, $account_name, $bank, $account_number);
                    error_log('recipient: '.$recipient);
                    $stmt =  $dbh->prepare("UPDATE payout_requests SET recipient = :recipient, data = :data, error = :error WHERE id = ".$id);
                    $stmt->bindParam(':recipient', $recipient->data->recipient_code);
                    $stmt->bindParam(':error', '');
                    $data = serialize($recipient->data);
                    $stmt->bindParam(':data', $data);
                    $stmt->execute();
                    
                } catch(\Yabacon\Paystack\Exception\ApiException $e){
                    $stmt =  $dbh->prepare("UPDATE payout_requests SET recipient = :recipient, data = :data, error = :error WHERE id = ".$id);
                    $recipient = false;
                    $stmt->bindParam(':recipient', $recipient);
                    $message = $e->getMessage();
                    $stmt->bindParam(':error', $message);
                    $data = serialize($e->getResponseObject());
                    $stmt->bindParam(':data', $data);
                    $stmt->execute();
                }
                

                //deduct requested amount from balance and keep on hold
                $success = "Request has been submitted successfully";
                $_POST = [];
            } else {
                error_log(json_encode($stmt->errorInfo()));
                $error = "Couldn't complete request";
            }
            
            
            
        } 
       
    } else {

    }
}
