<?php 
    require_once('../models/Connection.php');
    require_once('../models/Plant.php');

    $connection = Connection::Instance(); 

    // Select Database
     mysqli_select_db($connection, 'planty');

    if (isset($_POST['p_submit'])) {
        if(isset($_POST['album'])){
            // Add plant to album
            $album = $_POST['album'];
            $id = $_POST['p_plant_id'];

            $tableName = 'plant_album';

            $query = "INSERT INTO ". $tableName . " (id_plant, id_album) values ("
                . $id . ", "
                ."(SELECT id FROM album WHERE name='" .$album . "'));";

            // Execute query
            if (!($connection->query($query))){
                //echo mysqli_errno($connection);
                header('Location: ../views/error.html');
            }
            else {
                header('Location: ../views/dashboard.php');
            }
        }
    }
    else if (isset($_POST['p_submit_del'])) {
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
    }
?>