<?php 
require_once('../models/Album.php');
$connection = Connection::Instance();

if (isset($_POST['a_submit'])) {
    $name = mysqli_real_escape_string($connection, $_POST['a_name']);
    $short_description = mysqli_real_escape_string($connection, $_POST['a_description']);
    
    // Create User object
    
    $album = new Album($name, $short_description);

    if($album->addAlbum()) {
        // If query was successful, redirect to dashboard
        header('Location: ../views/dashboard.html');
    }
    else {
        // "Something went wrong" message should appear
        header('Location: ../views/index.html');
    }
}
?>