<?php
ob_start();
$admin = 0;
require "../../inc/config.php";

?>

[
    
		<?php
		
		$sql2 = "SELECT * FROM activity_log  ORDER BY ID DESC";
		$stm2 = $dbh->prepare($sql2);
		$stm2->execute();
		$activity= $stm2->fetchAll();
		$count = 0;
		
		$sql2 = "SELECT COUNT(*) as count FROM activity_log";
		$stm2 = $dbh->prepare($sql2);
		$stm2->execute();
		$count4 = $stm2->fetchColumn();
			
		foreach ($activity as $u1) {
		$count = $count+1; 
		
		?>
		{
        "id": "<?php echo $u1['id']; ?>",
		"username": "<?php echo $u1['user']; ?>",
		"ip": "<?php echo $u1['ip']; ?>",
		"message": "<?php echo $u1['message']; ?>",
		"time": "<?php echo date("g:ia - d M Y", $u1['time']); ?>",
		"other": "<?php if($u1['about'] == "Admin"){ echo 'Admin Panel'; }else{ echo $u1['about'];} ?>"
		}<?php if($count != $count4){ echo ',';} ?>
		<?php } ?>
    
]