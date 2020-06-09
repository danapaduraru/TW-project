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
    
    $query = "INSERT INTO plant(name, family, collection, collector, location, image) VALUES ('"
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
?>

