<?php 
    require_once('../models/Connection.php');
    require_once('../models/Album.php');
    $connection = Connection::Instance();

    mysqli_select_db($connection, 'planty');

        echo mysqli_error($connection);

        $tableName = 'album';

        $delete_a = new Delete($tableName);

        if($delete_a->deleteAlbum()) {
            // If query was successful, redirect to dashboard
            header('Location: ../views/dashboard.php');
        }
        else {
            // "Something went wrong" message should appear
            header('Location: ../views/error.html');
        }
?>