


<div class="contentcontainer contentbg">
	<div class="container-header blue-header">Recently added games</div>
	<div class="content-container">
	
		
	<?php
	$sql = "SELECT * FROM games ORDER BY id desc LIMIT 8";
	$stm = $dbh->prepare($sql);	
	$stm->execute();
	$u = $stm->fetchAll();
	
	$count = 0;
	foreach ($u as $game) {
	
	?>					
	<div class="col-xs-3 col-sm-2 col-md-3" style="margin-bottom:10px;">
		<a href="game.php?g=<?php echo $game['url']; ?>" class="" >
			<img src="<?php echo $game['image']; ?>" style="border:4px solid #292c32;border-radius:3px;height:52px;width:52px;" alt="...">
		</a>
	</div>
	<?php } ?>
				 
	</div>
</div>

<div class="contentcontainer contentbg">
	<div class="container-header blue-header">Random games</div>
	<div class="content-container">
	
		
	<?php
	$sql = "SELECT * FROM games ORDER BY rand() LIMIT 8";
	$stm = $dbh->prepare($sql);	
	$stm->execute();
	$u = $stm->fetchAll();
	
	$count = 0;
	foreach ($u as $game) {
	
	?>					
	<div class="col-xs-3 col-sm-2 col-md-3"  style="margin-bottom:10px;">
		<a href="game.php?g=<?php echo $game['url']; ?>" class="" >
			<img src="<?php echo $game['image']; ?>" style="border:4px solid #292c32;border-radius:3px;height:52px;width:52px;" alt="...">
		</a>
	</div>
	<?php } ?>
				 
	</div>
</div>
<?php if($i['ads_enabled'] == "1"){ ?>				
<div class="contentcontainer contentbg">
	<div class="container-header blue-header">Advertisement</div>
	<div class="content-container">

	<?php echo $i['ad_1']; ?>
	</div>
</div>
<?php } ?>