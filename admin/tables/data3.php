<?php
ob_start();
$admin = true;
require "../../inc/config.php";
?>

[

    <?php

        $sql2 = "SELECT * FROM games  ORDER BY ID asc";
        $stm2 = $dbh->prepare($sql2);
        $stm2->execute();
        $games= $stm2->fetchAll();
        $count = 0;
        
        $sql2 = "SELECT COUNT(*) as count FROM games";
        $stm2 = $dbh->prepare($sql2);
        $stm2->execute();
        $count4 = $stm2->fetchColumn();
            
        foreach ($games as $game) {
            $sql2 = "SELECT COUNT(*) as count FROM games_comments WHERE game_id = '".$game['id']."'";
            $stm2 = $dbh->prepare($sql2);
            $stm2->execute();
            $count5 = $stm2->fetchColumn();
        
            $count = $count+1;
        
            $stmt1 = $dbh->prepare("SELECT * FROM games_categories WHERE `id` = :id");
            $stmt1->bindValue(':id', $game['category_id']);
            $stmt1->execute();
            $category = $stmt1->fetch(); ?>
        {
        "id": "<?php echo $game['id']; ?>",
        "title": "<?php echo $game['title']; ?>",
        "category": "<?php echo $category['title']; ?>",
        "comments": "<?php echo $count5; ?>",
        "date": "<?php echo date("d M Y", $game['date']); ?>",
        "status": "<?php if ($game['status'] == "1") {
                ?><span class='label label-success'>Active</span><?php
            } else {
                ?><span class='label label-default'>Inactive</span><?php
            } ?>",
        "edit": "<a href='manage_games.php?p=edit&game=<?php echo $game['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a> <a href='manage_games.php?p=delete&game=<?php echo $game['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> "
        }<?php if ($count != $count4) {
                echo ',';
            } ?>
        <?php
        } ?>
    
]