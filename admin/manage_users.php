<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_users";
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
                <li><a href="manage_users.php"> Manage Users</a></li>
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
        
        
    <?php if ($page == "home") { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage users</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-url="tables/data1.php"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="username"  data-sortable="true">Username</th>
                                <th data-field="usergroup" data-sortable="true">User Group</th>
                                <th data-field="joindate" data-sortable="true">Join Date</th>
                                <th data-field="status" data-sortable="true">Status</th>
                                <th data-field="edit" data-sortable="true">Edit</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php } ?>
    <?php if ($page == "delete") { 
        //Gathers users
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username"); 
        $stmt->bindValue(':username', $_GET['user']);
        $stmt->execute(); 
        $user1 = $stmt->fetch();
            
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
        $stmt1->bindValue(':id', $in['usergroup']);
        $stmt1->execute(); 
        $in_perm = $stmt1->fetch();
            
        if($_POST['deleteuser']) {
            activitylog(''.$in['username'].'', 'deleted '.$user1['username'].'', ''.time().'', 'Admin');
            $sql = "DELETE FROM `users` WHERE id = '".$user1["id"]."'";
            $dbh->exec($sql);
            header("location: manage_users.php");   
        }
            
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete <?php echo $user1['username']; ?></div>
                    <div class="panel-body">
                    <form method="post">
                    <div class="form-group">
                <label for="viewprofile">Are you sure you would like to delete this user? This can not be undone!!<br />
                    
                </label>
              </div>
              <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Delete user" name="deleteuser"> 
                 <a class="btn btn-primary" href="manage_users.php">Cancel</a>
                    </form>    
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php } ?>
        
    <?php if ($page == "ban") { 
        //Gathers users
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username"); 
        $stmt->bindValue(':username', $_GET['user']);
        $stmt->execute(); 
        $user1 = $stmt->fetch();
            
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
        $stmt1->bindValue(':id', $in['usergroup']);
        $stmt1->execute(); 
        $in_perm = $stmt1->fetch();
            
        if($_POST['banuser1']) {
            if($user1['banned'] == "0") {
                activitylog(''.$in['username'].'', 'banned '.$user1['username'].'', ''.time().'', 'Admin');
                $sql = $dbh->prepare("UPDATE users SET banned='1' WHERE id=".$user1['id']."");
                $sql->execute();
                header("location: manage_users.php");
            }
            if($user1['banned'] == "1") {
                activitylog(''.$in['username'].'', 'unbanned '.$user1['username'].'', ''.time().'', 'Admin');
                $sql = $dbh->prepare("UPDATE users SET banned='0' WHERE id=".$user1['id']."");
                $sql->execute();
                header("location: manage_users.php");
            }
        }
            
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php if($user1['banned'] == "0") { echo 'Ban'; 
                   }else { echo 'Unban'; 
} ?> <?php echo $user1['username']; ?></div>
                    <div class="panel-body">
                    <form method="post">
                    <div class="form-group">
                <label for="viewprofile"><?php if($user1['banned'] == "0") { echo 'Are you sure you would like to ban this user?'; 
               }else { echo 'Are you sure you would like to unban this user?'; 
} ?> <br />
                    
                </label>
              </div>
              <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="<?php if($user1['banned'] == "0") { echo 'Ban'; 
             }else { echo 'Unban'; 
} ?> user" name="banuser1"> 
                 <a class="btn btn-primary" href="manage_users.php">Cancel</a>
                    </form>    
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    <?php } ?>
        
        
        
        
        
    <?php if ($page == "edit") {
        //Gathers users
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username"); 
        $stmt->bindValue(':username', $_GET['user']);
        $stmt->execute(); 
        $user1 = $stmt->fetch();
            
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
        $stmt1->bindValue(':id', $in['usergroup']);
        $stmt1->execute(); 
        $in_perm = $stmt1->fetch();
            
            
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit <?php echo $user1['username']; ?></div>
                    <div class="panel-body">
                        <div class="panel-body tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
                            <li><a href="#tab2" data-toggle="tab">Change password</a></li>
                            <li><a href="#tab3" data-toggle="tab">Change profile</a></li>
                            <li><a href="#tab4" data-toggle="tab">Change profile picture</a></li>
                        </ul>
        
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1">
        <?php
        //Update settings
        if(isset($_POST['updateuser_settings'])) {
            if($in["username"]) {
                        
                $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
                activitylog(''.$in['username'].'', 'edited '.$user1['username'].'', ''.time().'', 'Admin');
                $sql = $dbh->prepare("UPDATE users SET email='".$_POST['email']."', firstname='".$_POST['firstname']."', country='".$_POST['country']."', gender='".$_POST['gender']."',timezone='".$_POST['timezone']."', dob='".$_POST['dob']."', hide_offline='".$_POST['hide_offline']."', viewprofile='".$_POST['viewprofile']."', usergroup='".$_POST['usergroup']."' WHERE id=".$user1['id']."");
                $sql->execute();
                $success = "".$user1['username']."'s profile has been updated!";
                header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=user");
                        
            }
        }

        ?>
                <form method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" value="<?php echo $user1['email']; ?>" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="name">First name</label>
                <input type="text" class="form-control" id="name" name="firstname" placeholder="First name" value="<?php echo $user1['firstname']; ?>">
              </div>
              <div class="form-group">
                <label for="hide_offline">Gender<br />
                    <select id="hide_offline" name="gender">
                        <option value="Male" <?php if($user1['gender'] == "Male") { echo 'selected'; 
                       } ?>>Male</option>
                        <option value="Female" <?php if($user1['gender'] == "Female") { echo 'selected'; 
                       } ?> >Female</option>
                        <option value="(unspecified)" <?php if($user1['gender'] == "(unspecified)") { echo 'selected'; 
                       } ?> >(unspecified)</option>
                    </select>
                </label>
              </div>
              <div class="form-group">
                <label for="hide_offline">User group<br />
                    <select id="hide_offline" name="usergroup">
                    
        <?php
        $sql2 = "SELECT * FROM usergroups ORDER BY ID DESC";
        $stm2 = $dbh->prepare($sql2);
        $stm2->execute();
        $nodes2= $stm2->fetchAll();
        $count = 0;
                        
                    
        foreach ($nodes2 as $n1) {
                    
            ?>
                        <option value="Male" <?php if($user1['usergroup'] == "".$n1['id']."") { echo 'selected'; 
                       } ?>><?php echo $n1['name']; ?></option>
        <?php } ?>
                    </select>
                </label>
              </div>
              
              <div class="form-group">
                <label for="exampleInputFile">Country</label>
                <select name="country" class="form-control">
        <?php $countries = array("Choose a country", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
                
        foreach ($countries as $country) {
            echo '<option ';
            if($user1['country'] == $country) { echo 'selected'; 
            }
            echo ' value="'.$country.'">'.$country.'</option>';
        }
                
        ?>
                </select>
                </div>
                <div class="form-group">
                 <label for="timeZone">Timezone<br />
                        <select id="timeZone" class="form-control" name="timezone">
                        
        <?php 
        if($user1['timezone']) {
            echo displayTimeZoneSelect("".$user1['timezone']."");
        }else{
            echo displayTimeZoneSelect("America/New_York");
        }?>
                    </select>
                </label>
              </div>
              <div class="form-group">
                <label  for="exampleInputEmail2">Date of birth</label>
                <input type="date" name="dob" class="form-control" value="<?php echo $user1['dob']; ?>" required>
              </div>
              
              <div class="form-group">
                <label for="hide_offline">Hide offline <small>Other users won't be able to see if you are online</small><br />
                    <select id="hide_offline" name="hide_offline">
                        <option <?php if($user1['hide_offline'] == "0") { echo 'selected'; 
                       } ?> value="0">No</option>
                        <option <?php if($user1['hide_offline'] == "1") { echo 'selected'; 
                       } ?> value="1">Yes</option>
                    </select>
                </label>
              </div>
              <div class="form-group">
                <label for="viewprofile">Profile hidden <small>Hide your profile from users</small><br />
                    <select id="viewprofile" name="viewprofile">
                        <option <?php if($user1['viewprofile'] == "0") { echo 'selected'; 
                       } ?> value="0">No</option>
                        <option <?php if($user1['viewprofile'] == "1") { echo 'selected'; 
                       } ?> value="1">Yes</option>
                    </select>
                </label>
              </div>
              <input type="submit" style="float:left;"class="btn btn-primary" value="Update information" name="updateuser_settings">
            </form>
                            </div>
                            <div class="tab-pane fade" id="tab2">
                                <div class="well">
                                
        <?php
        //Update password
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username"); 
        $stmt->bindValue(':username', $_GET['user']);
        $stmt->execute(); 
        $user1 = $stmt->fetch();
            
        if(isset($_POST['updateuserpassword'])) {
                    
            $newpassword = "".$_POST['newpassword']."";
            $confirmpassword = "".$_POST['confirmpassword']."";
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
                            
            if($newpassword == $confirmpassword) {
                                
                                
                $password_hashed = password_hash($newpassword, PASSWORD_DEFAULT);
                activitylog(''.$in['username'].'', 'changed password for '.$user1['username'].'', ''.time().'', 'Admin');
                $sql = $dbh->prepare("UPDATE users SET password='".$password_hashed."' WHERE id=".$user1['id']."");
                $sql->execute();
                $success = "Your password has been updated";
                header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=password");
                                    
                                
            }else{
                $error = "The two passwords you have entered are not the same";
            }
                        
        }

        ?>
                <form method="post">

                <div class="form-group">
                    <label>New password</label>
                    <input type="password" class="form-control" placeholder="New password" name="newpassword"></input>
                </div>
                
                <div class="form-group">
                    <label>Confirm new password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" name="confirmpassword"></input>
                </div>
                <input type="submit" class="btn btn-primary" value="Update password" name="updateuserpassword">
                </form>
              </div>
                            </div>
        <div class="tab-pane fade" id="tab3">
                            
        <?php
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username"); 
        $stmt->bindValue(':username', $_GET['user']);
        $stmt->execute(); 
        $user1 = $stmt->fetch();
        
        if(isset($_POST['updateuserabout'])) {
            activitylog(''.$in['username'].'', 'changed about me for '.$user1['username'].'', ''.time().'', 'Admin');
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            $sql = $dbh->prepare("UPDATE users SET aboutme='".$_POST['aboutme']."' WHERE id=".$user1['id']."");
            $sql->execute();
            $success = "Profile updated";
            header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=user");
        }
        ?>
        <form method="post">
            
              
                <div class="form-group">
                <label for="name">About</label></b>
                <textarea class="form-control" name="aboutme" style="height:100px"><?php echo $user1['aboutme']; ?></textarea>
              </div>
              <input type="submit" style="float:left;"class="btn btn-primary" value="Update information" name="updateuserabout">
        </form>
                            </div>
                            
                            
                            <div class="tab-pane fade" id="tab4">
                            
        <?php
        $stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username"); 
        $stmt->bindValue(':username', $_GET['user']);
        $stmt->execute(); 
        $user1 = $stmt->fetch();
        
        //Upload avatar
        $target_dir = "../files/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $new_name = $location.time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload"]["name"];
        $target_file2 = $target_dir . basename($new_name);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["uploaduseravatar"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
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
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
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
        
                    $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
    
    
                    activitylog(''.$in['username'].'', 'updated profile picture for '.$user1['username'].'', ''.time().'', 'Admin');
                    $sql = $dbh->prepare("UPDATE users SET profilepic='".$currenturl."/files/uploads/".$new_name."', gravatar='0' WHERE id=".$user1['id']."");
                    $sql->execute();
                    $success = "".$currenturl."/".$new_name."";
                    header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=profilepic");
                } else {
                    $error = "Sorry, there was an error uploading your profile picture";
                }
            }
        }

        //Enabling gravatar
        if(isset($_POST['enableusergravatar'])) {
            if($in["username"]) {
                if($_POST['usegravatar'] == "1") {
                      activitylog(''.$in['username'].'', 'updated profile picture for '.$user1['username'].'', ''.time().'', 'Admin');
                      $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
                      $sql = $dbh->prepare("UPDATE users SET gravatar='1' WHERE id=".$user1['id']."");
                      $sql->execute();
                      $success = "Gravatar activated";
                      header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=profilepic");
            
                }else{
                      activitylog(''.$in['username'].'', 'updated profile picture for '.$user1['username'].'', ''.time().'', 'Admin');
                      $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
                      $sql = $dbh->prepare("UPDATE users SET gravatar='0' WHERE id=".$user1['id']."");
                      $sql->execute();
                      $success = "Gravatar disabled";
                      header("location: ".$currenturl."".$_SERVER[REQUEST_URI]."&success=profilepic");
                }
        
            }
        }

        ?>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseGravatar" aria-expanded="false" aria-controls="collapseGravatar" style="width:100%;text-align:left;">
            Set Gravatar as profile picture
            </button>
            <div class="collapse" id="collapseGravatar">
              <div class="well">
        <?php
        if(if_gravatar("".$user1['email']."") == "true") { 
            ?>
        <form method="post">
                <label for="usegravatar">Use gravatar<br />
                    <select id="usegravatar" name="usegravatar">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </label>
                <img src="<?php echo get_gravatar("".$user1['email'].""); ?>" style="height:100px;float:right;">
                  <br>
                  <button type="submit" name="enableusergravatar" class="btn btn-primary">Submit</button>
                  </form>
        <?php }else{ ?>
                 </b>No gravatar has been linked to this email: <b><?php echo $user1['email']; ?></b>
        <?php } ?>
                </div>
              </div>
             
            <br>
            <br>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAvatar" aria-expanded="false" aria-controls="collapseAvatar" style="width:100%;text-align:left;">
            Upload new profile picture
            </button>
            <div class="collapse" id="collapseAvatar">
              <div class="well">
                <form method="post" enctype="multipart/form-data">
            <label>Upload Avatar</label>
            <div class="form-group">
            <input type="file" class="btn btn-default" name="fileToUpload" id="fileToUpload">
            <input type="submit" style="float:left;"class="btn btn-primary" value="Upload Image" name="uploaduseravatar"><br>
            </div>
        </form>
        
        
        
                            </div>
                        </div>
                    </div>
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
