<?php
ob_start();
$admin = 0;
require "../../inc/config.php";

?>

[
    
		<?php
		
		$sql2 = "SELECT * FROM games  ORDER BY ID asc";
		$stm2 = $dbh->prepare($sql2);
		$stm2->execute();
		$users= $stm2->fetchAll();
		$count = 0;
		
		$sql2 = "SELECT COUNT(*) as count FROM games";
		$stm2 = $dbh->prepare($sql2);
		$stm2->execute();
		$count4 = $stm2->fetchColumn();
			
		foreach ($users as $u1) {
			
		$sql2 = "SELECT COUNT(*) as count FROM games_comments WHERE game_id = '".$u1['id']."'";
		$stm2 = $dbh->prepare($sql2);
		$stm2->execute();
		$count5 = $stm2->fetchColumn();
		
		$count = $count+1; 
		
		$stmt1 = $dbh->prepare("SELECT * FROM games_categories WHERE `id` = :id"); 
		$stmt1->bindValue(':id', $u1['category_id']);
		$stmt1->execute(); 
		$category_name = $stmt1->fetch();
		?>
		{
        "id": "<?php echo $u1['id']; ?>",
        "title": "<?php echo $u1['title']; ?>",
        "category": "<?php echo $category_name['title']; ?>",
		"comments": "<?php echo $count5; ?>",
		"date": "<?php echo date("d M Y", $u1['date']);  ?>",
		"status": "<?php if($u1['status'] == "1") { ?><span class='label label-success'>Active</span><?php }else{ ?><span class='label label-default'>Inactive</span><?php } ?>",
		"edit": "<a href='manage_games.php?p=edit&game=<?php echo $u1['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a> <a href='manage_games.php?p=delete&game=<?php echo $u1['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> "
		}<?php if($count != $count4){ echo ',';} ?>
		<?php } ?>
    
]