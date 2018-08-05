 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	
	<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php" class="nodecoration" ><div class="logo"><?php echo $i['title'];?></div></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($pagename == "home"){ echo 'class="active"'; }?>><a href="index.php">Home </a></li>
		<li class="dropdown" class="dark">
          <a href="#" class="dropdown-toggle dark" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
				<li><a class="white" href="games.php">View ALL</a></li>
				<?php
					$sql = "SELECT * FROM games_categories WHERE status = '1' ORDER BY id";
					$stm = $dbh->prepare($sql);
					$stm->execute();
					$category = $stm->fetchAll();

					$count = 0;
					foreach ($category as $c) {
						
					
				?>
				<li><a class="white" href="cat.php?c=<?php echo $c['title'];?>"><?php echo $c['title'];?></a></li>
				<?php } ?>
            
          </ul>
        </li>
      </ul>
	  
	  <form method="post" action="search.php?go" class="navbar-form navbar-left hidden-xs">
        <div class="form-group">
			<input type="text" name="search-text" class="form-control" autocomplete="off" spellcheck="false" placeholder="Search game....">
          
        </div>
        <button type="button" name="search-button" class="form-submit btn btn-search-nav"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
	  
      
      <ul class="nav navbar-nav navbar-right">
<?php 
//If not signed in
$user = $in['username'];
if(!$user){
?>
        <li class="dropdown">
          <a href="#" class="light" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">

								 <form class="form" method="post" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
											 <input type="email" name="email" class="form-control" placeholder="Email address" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="exampleInputPassword2">Password</label>
											 <input type="password" name="password" class="form-control" placeholder="Password" required>
										
										</div>
										
										<div class="form-group">
											
											 <?php if($i['captcha'] == "1"){ ?>
											<img src="inc/captcha.php" style="float:left;"/>
											<input placeholder='Captcha' maxlength="4" style="width:170px;padding:9px;color:#272727;"  name="captcha" type="text">
											<?php } ?>
											
                                             <div class="help-block text-right forgotpass"><a href="forgotpass.php">Forget the password ?</a></div>
										</div>
										
										
										<div class="form-group">
											 <input type="submit" name="login" class="btn btn-pink btn-block" value="Login">
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox" name="remember"> Remember me</input>
											 </label>
										</div>
								 </form>
								 

							</div>
							
					 </div>
				</li>
			</ul>
        </li>
        <li><a href="signup.php">REGISTER</a></li>
		</ul>
<?php
}else{
//if signed in
?>
	
	<?php if($in_perm['has_admin']){ ?><li class="dark"><a class="dark" href="admin/">Admin panel</a></li><?php } ?>
	
	
	
	<li class="dropdown">
          <a href="#" class="light" class="dropdown-toggle" data-toggle="dropdown">
			<img src="<?php echo $profilepic; ?>" class="profilepic" width="25px" height="25px"> 
			<b><?php echo $in['username']; ?></b> <span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a class="white" href="profile.php?u=<?php echo $in['username']; ?>">My profile</a></li>
			<li><a class="white" href="account_settings.php">Account settings</a></li>
            <li role="separator" class="divider"></li>
			<li><a class="white" href="logout.php">Logout</a></li>
			
			
			

          </ul>
	</li>
<?php } ?>
      
    </div>
  </div>
</nav>

<?php if($error){ ?>
<div style="margin-top:65px;">
<div class="container">
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>ERROR:</strong> <?php echo $error; ?>
	</div>
</div>
<?php } ?>

<?php if($success){ ?>
<div style="margin-top:65px;">
<div class="container">
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>SUCCESS:</strong> <?php echo $success; ?>
	</div>
</div>
<?php } ?>

<div class="container">
		<?php
		$sql = "SELECT * FROM site_notifications WHERE enabled = '1' ORDER BY id";
		$stm = $dbh->prepare($sql);
		$stm->execute();
		$notification = $stm->fetchAll();
		
		foreach ($notification as $n) {				
		?>
		<div class="notification-box border-left-red">
			<div class="notification-left">
				<i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
				<?php if($n['type'] == "notice"){ echo 'NOTICE:';} ?>
			</div>
			<div class="notification-middle">
				<?php echo $n['text']; ?>
			</div>
			<div class="notification-right">
				<a href="<?php echo $n['button_link']; ?>"><?php echo $n['button_text']; ?> <i class="fa fa-caret-right" aria-hidden="true"></i></a>
			</div>
		</div>
		
		<?php } ?>
</div>