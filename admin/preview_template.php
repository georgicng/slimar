<?php
ob_start();
$admin = true;
require "../inc/config.php";

if(!$in_perm['has_admin']) {
    header("location: ../index.php");
    exit;
}

$stmt1 = $dbh->prepare("SELECT * FROM email_templates WHERE `id` = :id"); 
$stmt1->bindValue(':id', $_GET['id']);
$stmt1->execute(); 
$group = $stmt1->fetch();
?><?php echo $group['content']; ?>
