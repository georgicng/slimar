<?php
ob_start();
$admin = 0;
require "../../inc/config.php";

?>

[
    
		<?php
		
		$sql2 = "SELECT * FROM users  ORDER BY ID asc";
		$stm2 = $dbh->prepare($sql2);
		$stm2->execute();
		$users= $stm2->fetchAll();
		$count = 0;
		
		$sql2 = "SELECT COUNT(*) as count FROM users";
		$stm2 = $dbh->prepare($sql2);
		$stm2->execute();
		$count4 = $stm2->fetchColumn();
			
		foreach ($users as $u1) {
		$count = $count+1; 
		
		$stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
		$stmt1->bindValue(':id', $u1['usergroup']);
		$stmt1->execute(); 
		$in_perm = $stmt1->fetch();
		?>
		{
        "id": "<?php echo $u1['id']; ?>",
        "username": "<?php echo $u1['username']; ?>",
        "usergroup": "<?php echo ucfirst($in_perm['name']); ?>",
		"joindate": "<?php echo date("d M Y", $u1['joindate']); ?>",
		"status": "<?php if($u1['banned'] == "0"){ echo "<font style='color:green';>Active</font>";}else{ echo "<font style='color:red'>Banned</font>";}  ?>",
		"edit": "<a href='manage_users.php?p=edit&user=<?php echo $u1['username']; ?>' class='btn btn-primary'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a> <a href='manage_users.php?p=delete&user=<?php echo $u1['username']; ?>' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> <a href='manage_users.php?p=ban&user=<?php echo $u1['username']; ?>' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i> Ban</a> "
		}<?php if($count != $count4){ echo ',';} ?>
		<?php } ?>
    
]