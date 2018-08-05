<?php
ob_start();
require "inc/config.php";

//This will be required for the active page in navigation
$pagename = "profile";


$profile_username = $_GET['u'];

//Gathers information for users profile
$stmt = $dbh->prepare("SELECT * FROM users WHERE `username` = :username"); 
$stmt->bindValue(':username', $profile_username);
$stmt->execute(); 
$cur_user = $stmt->fetch();

//Gathers users group ranking
$stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `id` = :id"); 
$stmt1->bindValue(':id', $cur_user['usergroup']);
$stmt1->execute(); 
$cur_user_perm = $stmt1->fetch();


//Gets user profile picture 
if(get_gravatar($cur_user['email']) && $cur_user['gravatar'] == "1")
{
	$profilepic2 = get_gravatar($cur_user['email']);
}else{
	$profilepic2 = $cur_user['profilepic'];
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


<div class="container">
    
</div>

</div>


<div class="container">
<!-- Inbox modal -->
<div class="modal fade" id="inboxModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send message to <?php echo $cur_user['username']; ?></h4>
      </div>
      <div class="modal-body">
        <form method="post">
		<input value="<?php echo $cur_user['id'];?>" name="userid" style="display:none;"></input>
		<input value="<?php echo $in['id'];?>" name="myid" style="display:none;"></input>
		
		  <div class="form-group">
			<label for="exampleInputEmail1">Subject</label>
			<input type="text" class="form-control" name="subject" placeholder="Subject">
		  </div>
		  <div class="form-group">
			<label for="exampleInputEmail1">Message</label>
			<textarea name="message" class="form-control" style="resize: vertical;height:150px;max-height:300px;" placeholder="Enter your message here...."></textarea>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="sendmessage" class="btn btn-primary" value="Send message"></input>
		</form>
      </div>
    </div>
  </div>
</div>
<!-- End of inbox modal -->

<?php 
if($cur_user['id']){
if($in_perm['view_any_profile'] == "1" || $cur_user['viewprofile'] == "1" || $cur_user['id'] == "".$in['id'].""){
?>
	
	  <div class="col-md-8 contentbg" style="padding:10px;padding-top:0px;">
	  <div style="padding:15px;padding-top:0px;">
	  
	  <div class="row user-menu-container square">
        <div class="col-md-12">
            <div class="row coralbg white">
				<div class="col-md-5 no-pad">
                    <div class="user-image">
                        <img src="<?php echo $profilepic2; ?>"  class="img-responsive thumbnail" style="margin-top:20px;height:220px">
                    </div>
                </div>




                <div class="col-md-6 no-pad text-center">
                    <div class="user-pad" style="margin-top:20px">
                        <h2><?php echo '<span style="'.$cur_user_perm['css'].'">'.htmlspecialchars($cur_user['username'], ENT_QUOTES, 'UTF-8').'</span>'; ?><h2>
						<h4 class="white"><?php echo $cur_user['gender']; ?> - <?php echo ucfirst($cur_user_perm['name']); ?> - <?php echo $cur_user['country']; ?><br><Br><b>Games played:</b> <?php echo $cur_user['games_played']; ?>
						<?php
						$sql = "SELECT count(*) FROM `games_comments` WHERE id_from = '".$cur_user['id']."'"; 
						$result = $dbh->prepare($sql); 
						$result->execute(); 
						$post_count = $result->fetchColumn(); 
						
						$sql = "SELECT count(*) FROM `games_rating` WHERE user_id = '".$cur_user['id']."'"; 
						$result = $dbh->prepare($sql); 
						$result->execute(); 
						$rating_count = $result->fetchColumn(); 
						?>
						<Br><b>Comments on games:</b> <?php echo $post_count; ?>
						<br><b>Games rated:</b> <?php echo $rating_count; ?></h4>
                        <br>
                       <?php if($in['id'] && $in['username'] != $cur_user['username']) { ?>

					   
					   <?php } ?>
					   
					  
                    </div>
                </div>
               
            </div>
            
        </div>
    </div>
	</div>
		<div class="contentcontainer" >
			
			
        <div class="" >
            
            <div class="">
			
			<div class="container-header blue-header">Profile comments</div>
			
                <ul class="list-group" >
				
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

				<?php
				if($_GET['page'] == ""){
					$page = 1;
				}else{
					$page = (int)$_GET['page'];
				}
				 
				$rowsPerPage = 10;
				$startLimit = ($page - 1) * $rowsPerPage; 
				
				
				$sql2 = "SELECT * FROM users_comments WHERE shown = '1'  && sub = '0' && id_to = '".$cur_user['id']."' ORDER BY ID DESC LIMIT {$startLimit}, {$rowsPerPage}";
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
									
									<a href="#comment<?php echo $n1['id']; ?>"><button type="button" id="comment<?php echo $n1['id']; ?>" class="btn btn-success btn-xs" title="reply">
                                        <i class="fa fa-reply" aria-hidden="true"></i> Reply
                                    </button></a>
									
								
									<?php if($commentuser1['us2ername'] == $in["username"]){ ?>
									<?php if($in['id']){ ?>
									<button type="button" class="btn btn-info btn-xs" title="like">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like
                                    </button>
									<?php } } ?>
									
									<?php if($commentuser1['username'] == $in["username"] || $in_perm['can_editcomment'] == "1"){ ?>
                                    <button type="button" data-toggle="modal" data-target="#editcomment<?php echo $n1['id']; ?>" class="btn btn-warning btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
									<?php } ?>
									<?php if($cur_user['username'] == $in["username"] || $commentuser1['username'] == $in["username"] || $in_perm['can_deletecomment'] == "1"){ 
									
									if($_POST['deletecomment'.$n1["id"].'']){
										$sql = "DELETE FROM `users_comments` WHERE id = '".$n1["id"]."'";
										$dbh->exec($sql);
										$sql2 = "DELETE FROM `users_comments` WHERE sub_id = '".$n1["id"]."'";
										$dbh->exec($sql2);
										header("location: profile.php?u=".$cur_user['username']."");   
										
									}
									
									if($_POST['editcomment'.$n1["id"].'']){
										$sql = $dbh->prepare("UPDATE users_comments SET message = :message WHERE id=".$n1["id"]."");
										$sql->bindParam(':message', $_POST['message']);
										$sql->execute();
										header("location: profile.php?u=".$cur_user['username']."");   
										
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
				$sql2 = "SELECT * FROM users_comments WHERE shown = '1' && sub_id = '".$n1['id']."' && sub = '1' ORDER BY ID ASC";
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
									<?php if($in['id']){ ?>
									<button type="button" class="btn btn-info btn-xs" title="like">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Like
                                    </button>
									<?php }} ?>
									
									<?php if($commentuser2['username'] == $in["username"] || $in_perm['can_editcomment'] == "1"){ ?>
                                    <button type="button" data-toggle="modal" data-target="#editcomment<?php echo $n2['id']; ?>" class="btn btn-warning btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
									<?php } ?>
									<?php if($cur_user['username'] == $in["username"] || $commentuser2['username'] == $in["username"] || $in_perm['can_deletecomment'] == "1"){
									
									if($_POST['deletecomment'.$n2["id"].'']){
										$sql = "DELETE FROM `users_comments` WHERE id = '".$n2["id"]."'";
										$dbh->exec($sql);
										header("location: profile.php?u=".$cur_user['username']."");   
										
									}
									if($_POST['editcomment'.$n2["id"].'']){
										$sql = $dbh->prepare("UPDATE users_comments SET message = :message WHERE id=".$n2["id"]."");
										$sql->bindParam(':message', $_POST['message']);
										$sql->execute();
										header("location: profile.php?u=".$cur_user['username']."");   
										
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

											<input type="submit" name="editcomment<?php echo $n2['id']; ?>" class="btn btn-warning" value="Edit">
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
				<script>
									$(document).ready(function(){
										$("#comment<?php echo $n1['id']; ?>").click(function(){
											$( "#commentbox<?php echo $n1['id']; ?>" ).fadeIn( "slow", function() {});
										});
									});
									</script>
									
									
								<div class="row profilecomment_reply" id="commentbox<?php echo $n1['id']; ?>" style="display:none;">
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
	
	$sql2 = "SELECT COUNT(*) as count FROM users_comments WHERE id_to = ".$cur_user['id']." && shown = '1'";
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
               </div>
 
</div>

                 				 
		</div>
		
		

	  </div>
	  
	  <div class="col-md-4" style="padding:10px;">
	<?php
	$sql = "SELECT count(*) FROM users_favourites WHERE user_id = '".$cur_user['id']."'"; 
	$result = $dbh->prepare($sql); 
	$result->execute(); 
	$favourite_count = $result->fetchColumn(); 
						
	?>

		
		
<div class="contentcontainer contentbg">
	<div class="container-header blue-header">Favourite games (<?php echo $favourite_count; ?>)</div>
	<div class="content-container">
	
		
	<?php
	$sql2 = "SELECT * FROM users_favourites WHERE user_id = '".$cur_user['id']."' ORDER BY id desc";
	$stm2 = $dbh->prepare($sql2);	
	$stm2->execute();
	$u2 = $stm2->fetchAll();
	foreach ($u2 as $game2) {
		$sql = "SELECT * FROM games WHERE id = '".$game2['game_id']."'";
		$stm = $dbh->prepare($sql);	
		$stm->execute();
		$u = $stm->fetchAll();
		
		foreach ($u as $game) {
	
	?>				
	
		
	<div class="col-xs-3 col-sm-2 col-md-3">
		<a href="game.php?g=<?php echo $game['url']; ?>" class="" >
			<img src="<?php echo $game['image']; ?>" style="border:4px solid #292c32;border-radius:3px;height:52px;width:52px;" alt="...">
		</a>
	</div>
	
	<?php 
	}

	}?>
				 
	</div>
</div>

<div class="contentcontainer contentbg">
	<div class="container-header blue-header">Most played games</div>
	<div class="content-container">
	
		
	<?php
	$sql = "SELECT * FROM games_played WHERE user_id = '".$cur_user['id']."'  ORDER BY times_played desc LIMIT 20";
	$stm = $dbh->prepare($sql);	
	$stm->execute();
	$u2 = $stm->fetchAll();
	
	$count = 0;
	foreach ($u2 as $game2) {
		
	$sql = "SELECT * FROM games WHERE id = '".$game2['game_id']."'";
	$stm = $dbh->prepare($sql);	
	$stm->execute();
	$u = $stm->fetchAll();
	
	$count = 0;
	foreach ($u as $game) {
	
	?>					
	<div class="col-xs-3 col-sm-2 col-md-3">
		<a href="game.php?g=<?php echo $game['url']; ?>" class="" >
			<img src="<?php echo $game['image']; ?>" style="border:4px solid #292c32;border-radius:3px;height:52px;width:52px;" alt="...">
		</a>
	</div>
	<?php }} ?>
				 
	</div>
</div>

	  
	  </div>

<?php }else{ ?>
<div class="col-md-12" style="padding:10px;">
	<div class="contentcontainer">
	<div class="title-pink">ERROR: User has hidden their profile </div>
	The current profile you are trying to access is hidden!<br><Br><B>If you do not believe this error is correct, please report this to a site administrator, or try again!</b>	
</div>
		
<?php } ?>

<?php }else{ ?>
<div class="col-md-12" style="padding:10px;">
	<div class="contentcontainer">
	<div class="title-pink">ERROR: Profile not found </div>
	The current profile you are trying to access does not exist!<br><Br><B>If you do not believe this error is correct, please report this to a site administrator, or try again!</b>	
</div>
		
<?php } ?>

	</div>
</div>



<?php include "inc/themes/user/footer.php" //This will be where the footer comes from ?>

</body>


</html>