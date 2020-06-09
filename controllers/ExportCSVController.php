<?php 
require_once('../models/Connection.php');

$connection = Connection::Instance();

// Select Database
mysqli_select_db($connection, 'planty');

// EXPORT CSV Functionality
if(isset($_POST['save-csv'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=statistics.csv');    
    $file = fopen("php://output", "w");
    
    // Most popular families
    $query = "SELECT family, count(*) from plant group by family;";
    $result = mysqli_query($connection, $query);
    fputcsv($file, array('Family', 'Number of plants'));
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, $row);
    }
    fputcsv($file, array(''));
    
    // Locations
    fputcsv($file, array('Location', 'Number of plants'));
    $query = "SELECT location, COUNT(*) FROM plant WHERE location not like '-' GROUP BY location;";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, $row);
    }
    fputcsv($file, array(''));
    
    // Comprehensive albums
    fputcsv($file, array('User name', 'Album Name', 'Number of plants'));
    $query = "SELECT u.fullname, a.name, COUNT(p.id_album) FROM user u join album a on u.id=a.user_id join plant_album p on a.id = p.id_album GROUP BY p.id_album ORDER BY COUNT(p.id_album) DESC LIMIT 10;";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, $row);
    }
    fputcsv($file, array(''));
    
    // Album Creators
    fputcsv($file, array('User name', 'Number of plants'));
    $query = "SELECT u.fullname, COUNT(a.user_id) FROM user u join album a on u.id = a.user_id GROUP BY a.user_id ORDER BY COUNT(a.user_id) DESC LIMIT 10;";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, $row);
    }
    fputcsv($file, array(''));
            
    // Planty statistics
    // Users
    $query = "SELECT COUNT(*) FROM user;";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    fputcsv($file, array('Users', $row[0]));
    fputcsv($file, array(''));
            
    // Albums
    $query = "SELECT COUNT(*) FROM album;";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    fputcsv($file, array('Albums', $row[0]));
    fputcsv($file, array(''));
            
    // Plants
    $query = "SELECT COUNT(*) FROM plant;";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    fputcsv($file, array('Plants', $row[0]));
    fputcsv($file, array(''));

    fclose($file);
} 
?>
