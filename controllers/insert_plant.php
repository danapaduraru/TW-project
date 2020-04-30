<?php 
require_once('../models/Connection.php');

function insertPlant($url, $name, $family, $collection, $collector, $location) {
    $connection = Connection::Instance();
    // Select Database
    mysqli_select_db($connection, 'planty');
    // Get image from URL
    $imageData = file_get_contents($url);
    // Escape special characters in a string for use in SQL query
    $imageBlob = mysqli_real_escape_string($connection, $imageData);
    
    $query = "INSERT INTO plant(name, family, collection, collecter, location, image) VALUES ('"
    . $name . "', '"
    . $family . "', '"
    . $collection . "', '"
    . $collector . "', '"
    . $location . "', '"
    . $imageBlob . "');";
    
    // Execute query
    if (!($connection->query($query)))
        echo mysqli_error($connection);
    else
        echo 'Plant inserted to DB.';
}

$url = 'http://www.kew.org/herbcatimg/489598.jpg';
$name = "Acorus gramineus";
$family = "Acoraceae ";
$collection = "RBG 436";
$collector = "Cope, T.A. ";
$location = "Zhejiang";

insertPlant($url, $name, $family, $collection, $collector, $location);

?>

