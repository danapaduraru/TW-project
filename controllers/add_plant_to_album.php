<?php 
    require_once('../models/Connection.php');

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
?>