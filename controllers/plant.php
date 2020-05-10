<?php 
    require_once('../models/Connection.php');

    $connection = Connection::Instance(); 

    // Select Database
     mysqli_select_db($connection, 'planty');

    if (isset($_POST['p_submit'])) {
        if(isset($_POST['album'])){

        //add plant to album
        $album = $_POST['album'];
        // $id = $_GET['id'];

        $tableName = 'plant_album';
        $query = "INSERT INTO ". $tableName . "(id_plant, id_album) values ('"
            .'4'. "', '"
            .'8'. "');";            
            // ."SELECT id FROM album WHERE name='" .$album . "');";
            echo $album, "<br>", $query;

            echo mysqli_errno($connection);

        // Execute query
        if (!($connection->query($query))){
            return false;
            echo mysqli_errno($connection);
            // header('Location: ../views/error.html');
        }
        return true;
        
        echo mysqli_errno($connection);
        echo"succes";
        // header('Location: ../views/dashboard.php');
    }
}
?>