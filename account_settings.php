<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "account_settings";

if(!$in['username']){
	header("location: index.php");
	exit;
}


?>
<!DOCTYPE html>
<html>
<head>
<?php include 'inc/themes/user/head.php' ?>
</head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/emojione/1.3.0/assets/css/emojione.min.css"/>
<link rel="stylesheet" href="shoutbox/assets/css/styles.css" />

<body class="game" id="page">
<?php include 'inc/themes/user/header.php' //This will be the navigation ?>




<div class="container contentbg">

	<div class="row">
	  <div class="col-md-6 " style="padding:10px;">
		<div class="contentcontainer">
		<div class="container-header blue-header">Change account settings</div>
			
			<form method="post">
			  <div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" class="form-control" name="email" value="<?php echo $in['email']; ?>" id="exampleInputEmail1" placeholder="Email">
			  </div>
			  <div class="form-group">
				<label for="name">First name</label>
				<input type="text" class="form-control" id="name" name="firstname" placeholder="First name" value="<?php echo $in['firstname']; ?>">
			  </div>
			  <div class="form-group">
				<label for="exampleInputFile">Country</label>
				<select name="country" class="form-control">
				<?php $countries = array("Choose a country", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
				
				foreach ($countries as $country) {
					echo '<option ';
					if($in['country'] == $country){ echo 'selected'; }
					echo ' value="'.$country.'">'.$country.'</option>';
				}
				
				?>
				</select>
				</div>
				<div class="form-group">
				 <label for="timeZone">Timezone<br />
						<select id="timeZone" class="form-control" name="timezone">
						
						<?php 
						if($in['timezone']){
							echo displayTimeZoneSelect("".$in['timezone']."");
						}else{
							echo displayTimeZoneSelect("America/New_York");
						}?>
					</select>
				</label>
			  </div>
			  <div class="form-group">
				<label  for="exampleInputEmail2">Date of birth</label>
				<input type="date" name="dob" class="form-control" value="<?php echo $in['dob']; ?>" required>
			  </div>
			  
			  <div class="form-group">
				<label for="hide_offline">Hide offline <small>Other users won't be able to see if you are online</small><br />
					<select id="hide_offline" name="hide_offline">
						<option <?php if($in['hide_offline'] == "0"){ echo 'selected'; } ?> value="0">No</option>
						<option <?php if($in['hide_offline'] == "1"){ echo 'selected'; } ?> value="1">Yes</option>
					</select>
				</label>
			  </div>
			  <div class="form-group">
				<label for="viewprofile">Profile hidden <small>Hide your profile from users</small><br />
					<select id="viewprofile" name="viewprofile">
						<option <?php if($in['viewprofile'] == "0"){ echo 'selected'; } ?> value="0">No</option>
						<option <?php if($in['viewprofile'] == "1"){ echo 'selected'; } ?> value="1">Yes</option>
					</select>
				</label>
			  </div>
			  <input type="submit" style="float:left;"class="btn btn-primary" value="Update information" name="updatesettings">
			</form>
			
                 				 
		</div>

	  </div>
	  
	  <div class="col-md-6" style="padding:10px;">
	  <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapsePassword" aria-expanded="false" aria-controls="collapsePassword" style="width:100%;text-align:left;">
			Change password
			</button>
			<div class="collapse" id="collapsePassword">
			  <div class="well">
				<form method="post">
				<div class="form-group">
					<label>Current password</label>
					<input type="password" class="form-control" placeholder="Current password" name="currentpassword"></input>
				</div>
				
				<div class="form-group">
					<label>New password</label>
					<input type="password" class="form-control" placeholder="New password" name="newpassword"></input>
				</div>
				
				<div class="form-group">
					<label>Confirm new password</label>
					<input type="password" class="form-control" placeholder="Confirm password" name="confirmpassword"></input>
				</div>
				<input type="submit" class="btn btn-primary" value="Update password" name="updatepassword">
				</form>
			  </div>
			  </div>
	  <div class="contentcontainer" style="margin-top:10px">
			<div class="container-header blue-header">Update profile picture</div>
			<b>
			<?php
			if(if_gravatar("".$in['email']."") == "true")
			{ 
			?>
			<div style="background:#e1e1e1;padding:5px;">
				<img src="https://d13yacurqjgara.cloudfront.net/users/4085/screenshots/2072398/gravatar.png" width="50px"> Gravatar has been detected with your email address
			</div>
			<?php
			}
			?>
			
			
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseGravatar" aria-expanded="false" aria-controls="collapseGravatar" style="width:100%;text-align:left;">
			Set Gravatar as profile picture
			</button>
			<div class="collapse" id="collapseGravatar">
			  <div class="well">
				<div class="form-group">To update or setup Gravatar, <a href="https://en.gravatar.com/connect/">click here</a> <br><br>
				<?php
				if(if_gravatar("".$in['email']."") == "true")
				{ 
				?>
				<form method="post">
				<label for="usegravatar">Use gravatar<br />
					<select id="usegravatar" name="usegravatar">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</label>
				<img src="<?php echo get_gravatar("".$in['email'].""); ?>" style="height:100px;float:right;">
				  <br>
				  <button type="submit" name="enablegravatar" class="btn btn-default">Submit</button>
				  </form>
				<?php }else{ ?>
				 </b>No gravatar has been linked to this email: <b><?php echo $in['email']; ?></b>
				<?php } ?>
				</div>
			  </div>
			 
			</div>
			
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAvatar" aria-expanded="false" aria-controls="collapseAvatar" style="width:100%;text-align:left;">
			Upload new profile picture
			</button>
			<div class="collapse" id="collapseAvatar">
			  <div class="well">
				<form method="post" enctype="multipart/form-data">
			<label>Upload Avatar</label>
			<div class="form-group">
			<input type="file" class="btn btn-default" name="fileToUpload" id="fileToUpload">
			<input type="submit" style="float:left;"class="btn btn-primary" value="Upload Image" name="uploadavatar">
			</div>
		</form>
			  </div>
			</div>
		<br><br>
		<div class="container-header blue-header">Update profile information </div>
		<form method="post">
			<div class="form-group">
				<label for="hide_offline">Gender<br />
					<select id="hide_offline" name="gender">
						<option value="Male" <?php if($in['gender'] == "Male"){ echo 'selected'; } ?>>Male</option>
						<option value="Female" <?php if($in['gender'] == "Female"){ echo 'selected'; } ?> >Female</option>
						<option value="(unspecified)" <?php if($in['gender'] == "(unspecified)"){ echo 'selected'; } ?> >(unspecified)</option>
					</select>
				</label>
			  </div>
			  
				<div class="form-group">
				<label for="name">About</label></b>
				<textarea class="form-control" name="aboutme" style="height:100px"><?php echo $in['aboutme']; ?></textarea>
			  </div>
			  <input type="submit" style="float:left;"class="btn btn-primary" value="Update information" name="updateabout">
		</form>
			  
		</div>
		
	  
	  </div>
	</div>
</div>



<?php include "inc/themes/user/footer.php" //This will be where the footer comes from ?>

</body>


</html>