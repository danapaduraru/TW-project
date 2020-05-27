<?php 
    require_once('../models/Connection.php');
    require_once('../models/Plant.php');

    $connection = Connection::Instance(); 

    // Select Database
     mysqli_select_db($connection, 'planty');

     $tableName = 'plant_album';

     echo mysqli_error($connection);

     $delete_p = new Delete($tableName);

     if($delete_p->deletePlant()) {
         // If query was successful, redirect to dashboard
         header('Location: ../views/dashboard.php');
     }
     else {
         // "Something went wrong" message should appear
         header('Location: ../views/error.html');
     }
?>