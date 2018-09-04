<?php
ob_start();
$admin = 0;
require "../../inc/config.php";

$sql2 = "SELECT * FROM users  ORDER BY ID asc";
$stm2 = $dbh->prepare($sql2);
$stm2->execute();
$users = $stm2->fetchAll();
$return = [];            
foreach ($users as $u1) {
    $return[] = [
        "id" => $u1['id'],
        "name" => $u1['firstname']." ".$u1['lastname'],
        "username" => $u1['username'],
    ];
} 
// set the header to make sure cache is forced
header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
// treat this as json
header('Content-Type: application/json');
echo json_encode($return);