<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "game";


$url = $_GET['g'];

$stmt = $dbh->prepare("SELECT * FROM games WHERE `url` = :url"); 
$stmt->bindValue(':url', $url);
$stmt->execute(); 
$cur_game = $stmt->fetch();

if($cur_game['id']){
	$stmt = $dbh->prepare("SELECT * FROM games_categories WHERE `id` = :category_id"); 
	$stmt->bindValue(':category_id', $cur_game['category_id']);
	$stmt->execute(); 
	$cur_game_category = $stmt->fetch();
}

if($in['id']){
	$games_played = $in['games_played'] + 1;
	$sql = $dbh->prepare("UPDATE users SET games_played = :new WHERE id=".$in["id"]."");
	$sql->bindParam(':new', $games_played);
	$sql->execute();
	
	//Games played
	$sql = "SELECT count(*) FROM games_played WHERE game_id = '".$cur_game['id']."' && user_id = '".$in['id']."'"; 
	$result = $dbh->prepare($sql); 
	$result->execute(); 
	$gameplayed = $result->fetchColumn(); 
	
	$stmt = $dbh->prepare("SELECT * FROM games_played WHERE game_id = '".$cur_game['id']."' && user_id = '".$in['id']."'"); 
	$stmt->execute(); 
	$gamesplayed2 = $stmt->fetch();
	
	if($gameplayed == 1){
		$new_played = $gamesplayed2['times_played'] + 1;
		
		$sql = $dbh->prepare("UPDATE games_played SET times_played = :new, time = :time, month_played = :month WHERE game_id = '".$cur_game['id']."' && user_id = '".$in['id']."'");
		$sql->bindParam(':new', $new_played);
		$sql->bindParam(':time', time());
		$sql->bindParam(':month', date("F", strtotime("first day of this month")));
		$sql->execute();
		
	}elseif($gameplayed == 0){
		$stmt = $dbh->prepare("INSERT INTO games_played (user_id, game_id, time, month_played, times_played) VALUES (:user_id, :game_id, :time, :month, 1)");
		$stmt->bindParam(':user_id', $in['id']);
		$stmt->bindParam(':game_id', $cur_game['id']);
		$stmt->bindParam(':time', time());
		$stmt->bindParam(':month', date("F", strtotime("first day of this month")));
		$stmt->execute();
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include 'inc/themes/user/head.php' ?>
		
		
	</head>

	<body class="home" id="page">
	<?php include 'inc/themes/user/header.php' //This will be the navigation ?>



	
		<div class="container">
		
			<div class="row">
			  <div class="col-md-8 contentbg" style="padding:10px;">
						<style>

    @media (min-width: 1200px) {
        .flash_container {
        }
    }

</style>

<style>
.fullscreen{
	height: 100vh;
	background:black;
        width: 100vw;
}
.fullscreen-safari{
	z-index: 9999; 
    width: 100%; 
    height: 100%; 
    position: fixed; 
    top: 0; 
    left: 0; 
}
.displaynone{
	display:none;
}
</style>
	<div id="player">
		<div class="container-header blue-header" id="gameheader"><?php echo $cur_game['title']; ?>
			<div style="Float:right;">
				<button onclick="goFullscreen('player'); return false" style="background:none;border:none;color:white;">
					<i class="fa fa-arrows-alt" aria-hidden="true"></i> Fullscreen</button></div>
		</div>
				<div  class="img-responsive propersize flash_container">  
				
				<?php if(empty($cur_game['file'])){

				?>
				<div style="contentbg" style="padding:10px">
				<font>No game file has been added for this game. If you are an administrator you can edit this by the administration panel.</font>
				</div>
				<?php } ?>
				<?php if($cur_game['type'] == "Flash"){ ?>
					<object class="embed-responsive embed-responsive-16by9" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="myFlashContent" >
						<param name="movie" value="<?php echo $cur_game['file']; ?>">
						<!--[if !IE]>-->
						<object type="application/x-shockwave-flash" data="<?php echo $cur_game['file']; ?>" >
						<!--<![endif]-->
						<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"></a>
						<!-- [if !IE]>-->
						</object>
						<!--<![endif]-->
					</object>
				<?php }else if($cur_game['type'] == "HTML5"){ ?>
				
				<div class="embed-responsive embed-responsive-16by9">
					<?php echo $cur_game['file']; ?>
					 
				</div>
				<br><br>
				<?php }else if($cur_game['type'] == "HTML5-url"){ ?>



									<!-- 16:9 aspect ratio -->
					<div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive" width="100%" src="<?php echo $cur_game['file']; ?>"></iframe>
					</div>
									<br><br>
				<?php } ?>
				
				
				</div>
	</div>

				
<script type="text/javascript">
function goFullscreen(id) {
	var element = document.getElementById(id);
	var elementheader = document.getElementById("gameheader");
	 
	
	var userAgent = window.navigator.userAgent;
	
	
	if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
		
			element.classList.add("fullscreen-safari");
			elementheader.classList.add("displaynone");
			
	}
	else {
	   
	var isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
        (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
        (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
        (document.msFullscreenElement && document.msFullscreenElement !== null);

    var docElm = document.documentElement;
    if (!isInFullScreen) {
		element.classList.add("fullscreen");
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullScreen) {
           element.webkitRequestFullScreen();
        } else if (element.msRequestFullscreen) {
            element.msRequestFullscreen();
        }
		
    } else {
		element.classList.remove("fullscreen");
        if (document.exitFullscreen) {
			element.classList.remove("fullscreen");
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
	
	}
}
</script>
				<?php if($cur_game['id']){?>
				
				<div class="contentcontainer contentbg">
					<div class="container-header blue-header"><?php echo $cur_game['title']; ?></div>
					<div style="padding:10px">
						<div class="row">
							<div class="col-sm-2 col-lg-2 col-md-2">
											
							<div class='wrapper'>
								<img class="img-responsive img-responsive2 responsive-img2" src='<?php echo $cur_game['image']; ?>' />
								
							</div>
								
							</div>
							
							<div class="col-sm-4 col-lg-6 col-md-4">
							
								<font style="font-size:20pt;"><?php echo $cur_game['title']; ?></font><br>
								<B>Date:</b> <?php echo date('M d, Y', $cur_game['date']); ?> - 
								<b>Category:</b> <a href="cat.php?c=<?php echo $cur_game_category['title']; ?>"> <?php echo $cur_game_category['title']; ?></a>
								<br><br><B>Description:</b><br>
								<?php echo $cur_game['description']; ?>
								<br><br>
								
								
					
							</div>
							
							<div class="col-sm-4 col-lg-4 col-md-4" style="text-align:right;">

							<?php 
							if($in['id']){
							$positive = $dbh->query("select count(*) from games_rating WHERE game_id = ".$cur_game['id']." && type = 'pos'")->fetchColumn(); 
							$negative = $dbh->query("select count(*) from games_rating WHERE game_id = ".$cur_game['id']." && type = 'neg'")->fetchColumn(); 
							
							$stmt = $dbh->prepare("SELECT * FROM games_rating WHERE `game_id` = :game_id && `user_id` = :user_id"); 
							$stmt->bindValue(':game_id', $cur_game['id']);
							$stmt->bindValue(':user_id', $in['id']);
							$stmt->execute(); 
							$rating = $stmt->fetch();
							
							
							$total = $positive - $negative;
							$currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
							
							if(isset($_POST["upvote"])) {
								if($rating['rating_id']){
									$sql = $dbh->prepare("UPDATE games_rating SET type='pos' WHERE game_id='".$cur_game['id']."' && user_id=".$in['id']."");
									$sql->execute();		
									header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
								}else{
									$stmt = $dbh->prepare("INSERT INTO games_rating (game_id, user_id, type) VALUES (:game_id, :user_id, 'pos')");
									$stmt->bindParam(':game_id', $cur_game['id']);
									$stmt->bindParam(':user_id', $in['id']);
									$stmt->execute();
									header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
								}
							}
							if(isset($_POST["downvote"])) {
								if($rating['rating_id']){
									$sql = $dbh->prepare("UPDATE games_rating SET type='neg' WHERE game_id='".$cur_game['id']."' && user_id=".$in['id']."");
									$sql->execute();		
									header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
								}else{
									$stmt = $dbh->prepare("INSERT INTO games_rating (game_id, user_id, type) VALUES (:game_id, :user_id, 'neg')");
									$stmt->bindParam(':game_id', $cur_game['id']);
									$stmt->bindParam(':user_id', $in['id']);
									$stmt->execute();
									header("location: ".$currenturl."/play.php?g=".$cur_game['url']."");
								}
							}
							?>
							<?php 
							if($total < 0){ 
							?>
							<span style="margin-left:-10px;color:red;font-weight:bold;padding:10px;background:#22252a;float:left;top:5px;"> <?php echo $total; ?></span>
							<?php
							}else{
							?>
							<span style="margin-left:-10px;color:green;font-weight:bold;padding:10px;background:#22252a;float:left;top:5px;"> <?php echo $total; ?></span>
							<?php } ?>
							<form method="post" style="float:right;">
								<button type="submit" class="btn <?php if($rating['type'] == "pos"){ echo 'btn-fav'; }else{ echo 'btn-fav2'; } ?>" name="upvote"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Upvote</button>
								<button type="submit" class="btn <?php if($rating['type'] == "neg"){ echo 'btn-fav'; }else{ echo 'btn-fav2'; } ?>" name="downvote"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Downvote</button>
							</form>
							
							<?php } ?>
							</div>
							<?php
							
									//favourites
									$stmt = $dbh->prepare("SELECT * FROM users_favourites WHERE `game_id` = :game_id && `user_id` = :user_id"); 
									$stmt->bindValue(':game_id', $cur_game['id']);
									$stmt->bindValue(':user_id', $in['id']);
									$stmt->execute(); 
									$fav = $stmt->fetch();
									
									if(isset($_POST["fav_add"])) {
										$stmt = $dbh->prepare("INSERT INTO users_favourites (game_id, user_id) VALUES (:game_id, :user_id)");
										$stmt->bindParam(':game_id', $cur_game['id']);
										$stmt->bindParam(':user_id', $in['id']);
										$stmt->execute();
										header("location: play.php?g=".$cur_game['url'].""); 
									}
									if(isset($_POST["fav_remove"])) {
										$sql = "DELETE FROM `users_favourites` WHERE game_id = '".$cur_game["id"]."' && user_id = '".$in["id"]."'";
										$dbh->exec($sql);
										header("location: play.php?g=".$cur_game['url'].""); 
									}

									if($in['id']){
									if($fav['id']){
									?>
									<form method="post" style="float:right;margin-right:15px;margin-top:5px;">
									<button type="submit" class="btn btn-fav" name="fav_remove"><i class="fa fa-heart" aria-hidden="true"></i> Favourited</button>
									</form>
									<?php }else{ ?>
									<form method="post" style="float:right;margin-right:15px;margin-top:5px;">
									<button type="submit" class="btn btn-fav2" name="fav_add"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to favourites</button>
									</form>
									<?php }} ?>
						</div>
					</div>
				</div>
				
				
				<div class="contentcontainer contentbg">
					<div class="container-header blue-header">Comments</div>
					<div class="content-container">
<?php if($cur_game['comments'] == "1"){ ?>
<?php
//Post comment
if(isset($_POST["postcommentprofile"])){
	
	if($in["username"]){
		$id_from = $in['id'];
		$id_to = $_POST['userid'];
		$message = strip_tags($_POST['message'], '<br><b><strong>');
		$date = $_POST['date'];	
		$currenttime = time();
		
		if($in['id'] != $id_from){
			echo 'oh no theres an error!';
			activitylog(''.$in['username'].'', 'SECURITY ERROR: USER TRYING TO SEND COMMENT AS DIFFERENT USER', ''.time().'');
		}else{
		activitylog(''.$in['username'].'', 'commented on a profile', ''.time().'');
		$stmt = $dbh->prepare("INSERT INTO games_comments (id_from, game_id, message, date) VALUES (:id_from, :id_to, :message, :date)");
		$stmt->bindParam(':id_from', $in['id']);
		$stmt->bindParam(':id_to', $cur_game['id']);
		$stmt->bindParam(':message', $message);
		$stmt->bindParam(':date', $currenttime);
		
		$stmt->execute();
		
		}
	}
		
}
?>
<?php
//Post reply
if(isset($_POST['postreplyprofile'])){
	
	if($in["username"]){
		$id_from = $in['id'];
		$id_to = $_POST['userid'];
		$message = strip_tags($_POST['message'], '<br><b><strong>');
		$date = $_POST['date'];	
		$currenttime = time();
		$sub_id = $_POST['postid'];
		$sub = "1";
		
		if($in['id'] != $id_from){
			echo 'oh no theres an error!';
			activitylog(''.$in['username'].'', 'SECURITY ERROR: USER TRYING TO SEND COMMENT AS DIFFERENT USER', ''.time().'');
		}else{
		activitylog(''.$in['username'].'', 'commented on a profile', ''.time().'');
		$stmt = $dbh->prepare("INSERT INTO games_comments (id_from, game_id, message, date, sub, sub_id) VALUES (:id_from, :id_to, :message, :date, :sub, :sub_id)");
		$stmt->bindParam(':id_from', $in['id']);
		$stmt->bindParam(':id_to', $cur_game['id']);
		$stmt->bindParam(':message', $message);
		$stmt->bindParam(':date', $currenttime);
		$stmt->bindParam(':sub', $sub);
		$stmt->bindParam(':sub_id', $sub_id);
		$stmt->execute();
		
		}
	}
		
}
?>
			
                <ul class="list-group" >
				<?php if($in['id']){ ?>
				<li class="list-group-item">
                        <div class="row" style="margin-top:5px;">
                            <div class="col-xs-2 col-md-1 hidden-sm hidden-xs">
							<?php if($in['id']){ ?>
							<img src="<?php echo $profilepic; ?>" class="img-circle" style="width:52px;height:52px" alt="" /><?php } ?></div>
                            <div class="col-xs-12 col-md-11">
                                <div>
							
                                   
                                </div>
								<?php if($in['id']){ ?>
                                <div class="comment-text">
									<form class="form" method="post">
										<div class="form-group">
										<input value="<?php echo $cur_user['id'];?>" name="userid" style="display:none;"></input>
											<textarea style="resize: vertical;" class="form-control" name="message" id="exampleInputEmail1" placeholder="Write something..."></textarea>
											<input style="float:right;" class="btn btn-primary  btn-sm" type="submit" name="postcommentprofile" value="Submit">
										</div>
									 </form>
                                </div>
								<?php } ?>
							</div>
						</div>
				</li>		
				<?php } ?>
				
				<?php
				if($_GET['page'] == ""){
					$page = 1;
				}else{
					$page = (int)$_GET['page'];
				}
				 
				$rowsPerPage = 10;
				$startLimit = ($page - 1) * $rowsPerPage; 
				
				
				$sql2 = "SELECT * FROM games_comments WHERE shown = '1'  && sub = '0' && game_id = '".$cur_game['id']."' ORDER BY ID DESC LIMIT {$startLimit}, {$rowsPerPage}";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$nodes2= $stm2->fetchAll();
				$count = 0;
					
				
				foreach ($nodes2 as $n1) {
				$count = $count + 1;
				
				//Gathers commented users info
				$stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id"); 
				$stmt->bindValue(':id', $n1['id_from']);
				$stmt->execute(); 
				$commentuser1 = $stmt->fetch();
				
				//Gathers commented users permissions
				$stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
				$stmt1->bindValue(':id', $commentuser1['usergroup']);
				$stmt1->execute(); 
				$commentuser1_perm = $stmt1->fetch();
				
				//Gets user profile picture 
				if(get_gravatar($commentuser1['email']) && $commentuser1['gravatar'] == "1")
				{
					$commentuser1_profilepic = get_gravatar($commentuser1['email']);
				}else{
					$commentuser1_profilepic = $commentuser1['profilepic'];
				}
					
				?>
                    <li class="list-group-item">
                        <div class="row" style="margin-top:5px;">
                            <div class="col-xs-2 col-md-1 hidden-sm hidden-xs">
                                <a href="profile.php?u=<?php echo $commentuser1['username']; ?>"><img src="<?php echo $commentuser1_profilepic; ?>" class="img-circle " style="width:42px;height:42px" alt="" /></a></div>
                            <div class="col-xs-12 col-md-11">
                                <div>
								<div class="action" style="float:right;">
								<?php if($in['id']){ ?>
									
									<a role="button" data-toggle="collapse" href="#collapse<?php echo $n1['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $n1['id']; ?>"><button type="button" id="comment<?php echo $n1['id']; ?>" class="btn btn-success btn-xs" title="reply">
                                        <i class="fa fa-reply" aria-hidden="true"></i> Reply
                                    </button></a>
									
								
									<?php if($commentuser1['us2ername'] == $in["username"]){ ?>
									<button type="button" class="btn btn-info btn-xs" title="like">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like
                                    </button>
									<?php } ?>
									
									<?php if($commentuser1['username'] == $in["username"] || $in_perm['can_editcomment'] == "1"){ ?>
                                    <button type="button" data-toggle="modal" data-target="#editcomment<?php echo $n1['id']; ?>" class="btn btn-warning btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
									<?php } ?>
									<?php if($cur_user['username'] == $in["username"] || $commentuser1['username'] == $in["username"] || $in_perm['can_deletecomment'] == "1"){ 
									
									if($_POST['deletecomment'.$n1["id"].'']){
										$sql = "DELETE FROM `games_comments` WHERE id = '".$n1["id"]."'";
										$dbh->exec($sql);
										$sql2 = "DELETE FROM `games_comments` WHERE sub_id = '".$n1["id"]."'";
										$dbh->exec($sql2);
										header("location: play.php?g=".$cur_game['url']."");   
										
									}
									
									if($_POST['editcomment'.$n1["id"].'']){
										$sql = $dbh->prepare("UPDATE games_comments SET message = :message WHERE id=".$n1["id"]."");
										$sql->bindParam(':message', $_POST['message']);
										$sql->execute();
										header("location: play.php?g=".$cur_game['url']."");  
										
									}
									?>
									
									<div class="modal fade" id="editcomment<?php echo $n1['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Edit comment</h4>
										  </div>
										  <div class="modal-body">
										<form class="form" method="post">
										<div class="form-group">
										<input value="<?php echo $cur_user['id'];?>" name="userid" style="display:none;"></input>
											<textarea style="resize: vertical;" class="form-control" name="message" id="exampleInputEmail1" placeholder=""><?php echo $n1['message']; ?></textarea>
											</div>

											<input type="submit" name="editcomment<?php echo $n1['id']; ?>" class="btn btn-warning" value="Edit">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										</form>
										  </div>
										  
										</div>
									  </div>
									</div>
									
                                    <div class="modal fade" id="delete<?php echo $n1['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this comment?</h4>
										  </div>
										  <div class="modal-body">
										<form method="post">
											<input type="submit" name="deletecomment<?php echo $n1['id']; ?>" class="btn btn-primary" value="Yes">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										</form>
										  </div>
										  
										</div>
									  </div>
									</div>

                                    <button type="button" data-toggle="modal" data-target="#delete<?php echo $n1['id']; ?>" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
									<?php } ?>
								<?php } ?>
                                </div>
                                   
                                    <div class="mic-info">
                                        <a href="profile.php?u=<?php echo $commentuser1['username']; ?>"><span style="<?php echo $commentuser1_perm['css'];?>;font-weight:Bold"><?php echo $commentuser1['username']; ?></span></a>
										<Small>on <?php echo date('M d, Y h:ia T', $n1['date']); ?> </small>
                                    </div>
                                </div>
                                <div class="comment-text">
									<?php echo $n1['message']; ?>
                                </div>
                                
				<?php
				$sql2 = "SELECT * FROM games_comments WHERE shown = '1' && sub_id = '".$n1['id']."' && sub = '1' ORDER BY ID ASC";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$nodes2= $stm2->fetchAll();

				foreach ($nodes2 as $n2) {
				
				//Gathers commented users info
				$stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id"); 
				$stmt->bindValue(':id', $n2['id_from']);
				$stmt->execute(); 
				$commentuser2 = $stmt->fetch();
				
				//Gathers commented users permissions
				$stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
				$stmt1->bindValue(':id', $commentuser2['usergroup']);
				$stmt1->execute(); 
				$commentuser2_perm = $stmt1->fetch();
				
				//Gets user profile picture 
				if(get_gravatar($commentuser2['email']) && $commentuser2['gravatar'] == "1")
				{
					$commentuser1_profilepic = get_gravatar($commentuser2['email']);
				}else{
					$commentuser1_profilepic = $commentuser2['profilepic'];
				}
					
				?>
								<!-- replies here-->
								<div class="row profilecomment_reply">
                            <div class="col-xs-2 col-md-1  hidden-sm hidden-xs">
                                <a href="profile.php?u=<?php echo $commentuser2['username']; ?>"><img src="<?php echo $commentuser1_profilepic; ?>" class="img-circle " style="width:42px;height:42px" alt="" /></a></div>
							<div class="col-xs-2 col-md-1  visible-sm visible-xs">
                               </div>
                            <div class="col-xs-10 col-md-11 ">
                                <div>
								<div class="action" style="float:right;">
									
                                    <?php if($commentuser2['userna2me'] == $in["username"]){ ?>
									<button type="button" class="btn btn-info btn-xs" title="like">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like
                                    </button>
									<?php } ?>
									
									<?php if($commentuser2['username'] == $in["username"] || $in_perm['can_editcomment'] == "1"){ ?>
                                    <button type="button" data-toggle="modal" data-target="#editcomment<?php echo $n2['id']; ?>" class="btn btn-warning btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
									<?php } ?>
									<?php if($cur_user['username'] == $in["username"] || $commentuser2['username'] == $in["username"] || $in_perm['can_deletecomment'] == "1"){
									
									if($_POST['deletecomment'.$n2["id"].'']){
										$sql = "DELETE FROM `games_comments` WHERE id = '".$n2["id"]."'";
										$dbh->exec($sql);
										header("location: play.php?g=".$cur_game['url']."");    
										
									}
									if($_POST['editcomment'.$n2["id"].'']){
										$sql = $dbh->prepare("UPDATE games_comments SET message = :message WHERE id=".$n2["id"]."");
										$sql->bindParam(':message', $_POST['message']);
										$sql->execute();
										header("location: play.php?g=".$cur_game['url'].""); 
										
									}
									?>
									
									<div class="modal fade" id="editcomment<?php echo $n2['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Edit comment</h4>
										  </div>
										  <div class="modal-body">
										<form class="form" method="post">
										<div class="form-group">
										<input value="<?php echo $cur_user['id'];?>" name="userid" style="display:none;"></input>
											<textarea style="resize: vertical;" class="form-control" name="message" id="exampleInputEmail1" placeholder=""><?php echo $n2['message']; ?></textarea>
											</div>

											<input type="submit" name="editcomment<?php echo $n2['id']; ?>" class="btn btn-primary" value="Edit">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										</form>
										  </div>
										  
										</div>
									  </div>
									</div>
									
                                    <div class="modal fade" id="delete<?php echo $n2['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this comment?</h4>
										  </div>
										  <div class="modal-body">
										<form method="post">
											<input type="submit" name="deletecomment<?php echo $n2['id']; ?>" class="btn btn-primary" value="Yes">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										</form>
										  </div>
										  
										</div>
									  </div>
									</div>

                                    <button type="button" data-toggle="modal" data-target="#delete<?php echo $n2['id']; ?>" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
									<?php } ?>
                                </div>
                                   
                                    <div class="mic-info">
                                        <a href="profile.php?u=<?php echo $commentuser2['username']; ?>"><span style="<?php echo $commentuser2_perm['css'];?>;font-weight:Bold"><?php echo $commentuser2['username']; ?></span></a>
										<Small>on <?php echo date('M d, Y h:ia T', $n2['date']); ?> </small>
                                    </div>
                                </div>
                                <div class="comment-text">
									<?php echo $n2['message']; ?>
                                </div>
                                
								<!-- replies here-->
                            </div>
							
                        </div>
				<?php } ?>
				
				<!-- replies here-->
						
									
						<div class="collapse" id="collapse<?php echo $n1['id']; ?>">			
								<div class="row profilecomment_reply" id="commentbox5" >
                            <div class="col-xs-2 col-md-1  hidden-sm hidden-xs">
                                <img src="<?php echo $profilepic; ?>" class="img-circle" style="width:42px;height:42px" alt="" /></div>
							<div class="col-xs-2 col-md-1  visible-sm visible-xs">
                               </div>
                            <div class="col-xs-10 col-md-11 " >
                                <div>
								
                                   <?php if($in['id']){ ?>
                                    <div class="mic-info"  >
                                       <form class="form" method="post">
										<div class="form-group">
										<input value="<?php echo $cur_user['id'];?>" name="userid" style="display:none;"></input>
										<input value="<?php echo $n1['id'];?>" name="postid" style="display:none;"></input>
											<textarea style="resize: vertical;" class="form-control" name="message" id="exampleInputEmail1" placeholder="Write something..."></textarea>
											<input style="float:right;" class="btn btn-primary  btn-sm" type="submit" name="postreplyprofile" value="Submit">
										</div>
									 </form>
                                    </div>
								   <?php } ?>
									
                                </div>
                                
                                
								<!-- replies here-->
                            </div>
						</div>
							
                        </div>
						<!--end of reply -->
                            </div>
							
                        </div>
                    </li>
					
                    <?php
					}
					
					?>
                   <nav aria-label="Page navigation"style="padding-left:10px">
  <ul class="pagination">
    
	<?php
	$currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/profile.php?u=".$cur_user['username']."";
	
	$sql2 = "SELECT COUNT(*) as count FROM games_comments WHERE id_to = ".$cur_user['id']." && shown = '1'";
	$stm2 = $dbh->prepare($sql2);
	$stm2->execute();
	$count= $stm2->fetchColumn(); 
				
	$totalNumberOfPages = ceil($count / $rowsPerPage);
	
	//pagination
	if($_GET['page'] == 1){
		$lastpage = $_GET['page'] - 1;
		echo '
		<li><a href="#" aria-label="Previous">
			<span aria-hidden="true">&laquo;</span>
		</a> </li>';
	}else{
		$lastpage = $_GET['page'] - 1;
		echo '
		<li><a href="'.$currenturl.'&page='.$lastpage.'#comment" aria-label="Previous">
			<span aria-hidden="true">&laquo;</span>
		</a></li>';
	}
	
	
	foreach(range(1, $totalNumberOfPages) as $pageNumber) {
		if(!$pageNumber == "0"){
		echo '<li><a href="'.$currenturl.'&page=' . $pageNumber . '#comment">'.$pageNumber.'</a></li>';
		}
	}
	
	
	if($_GET['page'] == $totalNumberOfPages){
		$nextpage = $_GET['page'] + 1;
		echo '
		<li><a href="#" aria-label="Next">
			<span aria-hidden="true">&raquo;</span>
		</a> </li>';
	}else{
		$nextpage = $_GET['page'] + 1;
		
		echo '
		<li><a href="'.$currenturl.'&page='.$nextpage.'#comment" aria-label="Next">
			<span aria-hidden="true">&raquo;</span>
		</a></li>';
	}
	
	
	?>
      
  </ul>
</nav>
                </ul>
				
<?php }else{ ?>
	<div class="alert alert-warning" role="alert">Comments on this game are disabled.</div>
<?php } ?>
					
					</div>
				</div>
				<?php } ?>
				
				
				<?php if($i['ads_enabled'] == "1"){ ?>
				<div class="contentcontainer" style="">
					<div class="container-header blue-header">Advertisement</div>
					<div class="content-container">

						<?php echo $i['ad_2']; ?>
					</div>
				</div>
				<?php } ?>
				
				
			  </div>
			  
			<div class="col-md-4" style="padding:10px;padding-top:0px;">
				<div class="contentcontainer contentbg">
					<div class="container-header blue-header">Share to social media</div>
					<div class="content-container">
					
						
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1726485340996652";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php $current_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

<div class="fb-share-button" style="Float:left;margin-right:5px;" data-href="<?php echo $current_link; ?>" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_link; ?>&amp;src=sdkpreparse">Share</a></div>

<a href="https://twitter.com/share" style="float:left;margin-right:5px;margin-top:-5px" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" style="float:left;" data-action="share" data-annotation="none" data-height="28"></div>
			 
					</div>
				</div>
			
				<?php include "inc/themes/user/side.php"; ?>
			</div>
			</div>
		</div>


		<?php include "inc/themes/user/footer.php" //This will be where the footer comes from ?>
	
		
	</body>
</html>