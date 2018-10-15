<?php
//Checks if details file exists
if (file_exists(__DIR__."/details.php")) {
    $installed = 1;
} else {
    $installed = 0;
}

ini_set('display_errors', 'off');
//We don't want errors to show, now do we?
$version = 1.0;
//Grabs database information
if ($installed == 1) {
    require __DIR__."/details.php";
   
    //Attempt to connect to database using above details.php
    try {
        $GLOBALS['dbh'] = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    } catch (PDOException $e) { 
        //if can't grab database information show error page
        echo '<h2>This website can not connect to the database</h2><br><br>';
        exit;
    }
    $dbh = $GLOBALS['dbh'];
        
    //This grabs basic site information from database. Example of use: $i["field name"];
    
    $sql = "SELECT * FROM site_settings";
    //$i = $dbh->query($sql);
    $i = [];
    foreach ($dbh->query($sql) as $row) {
        $i[$row['s_key']] = $row['s_value'];
    }
    include "class_functions.php";
    //This grabs user signed in information
    include "class_users.php";

    //Sets up timezone for user
    if (isset($in)) {
        if (!$in['timezone']) { //If no set timezone for user, use ip to find closest
            $user_ip = getip();
            $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
            $country = $geo["geoplugin_countryName"];
            $state = $geo["geoplugin_region"];
            //date_default_timezone_set($country."/".$state);
        } else { //Gets user set timezone
            date_default_timezone_set($in['timezone']);
        }
    }
    
    $stmt = $dbh->prepare("SELECT * FROM site_statistics WHERE `name` = 'pageviews'");
    $stmt->execute();
    $row = $stmt->fetch();
    $newcount = $row['amount']+1;
    $sql = $dbh->prepare("UPDATE site_statistics SET amount='".$newcount."' WHERE name='pageviews'");
    $sql->execute();

    
    $user_ip = getip();
    
    $sql2 = "SELECT COUNT(*) as count FROM visitors WHERE ip = '".$user_ip."'";
    $stm2 = $dbh->prepare($sql2);
    $stm2->execute();
    $count= $stm2->fetchColumn();
    
    
    
    if ($count == "0") {
        $stmt = $dbh->prepare("INSERT INTO visitors (ip) VALUES (:ip)");
        $ip = getip();
        $stmt->bindParam(':ip', $ip);
        $stmt->execute();
    }
} else {
    header("Location: install/");
}


//Checks if website is offline
$sitemaintainance = "".$i["offline"]."";
if (isset($in_perm) && $in_perm['has_admin'] != "1") {
    
    if ($sitemaintainance == '1') {
        if (basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']) != "maintenance.php") {
            header("Location: maintenance.php");
        }
    }
}
