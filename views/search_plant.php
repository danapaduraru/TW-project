<?php 
require_once('../models/User.php');
$connection = Connection::Instance();

// Select Database
mysqli_select_db($connection, 'planty');

// Create query from form fields
$query = "SELECT * FROM plant WHERE ";
$foundFirst = false;

if (isset($_POST['s_submit'])) {
    foreach($_POST as $name => $value) {
        if($value != null) {
            // remove _s from name
            $name = substr($name, 2);
            if($foundFirst) {
                $query = $query . " AND ";
            }
            else {
                $foundFirst = true; // first field added to sql statement
            }
            $query = $query . $name . " LIKE '%" . $value . "%'";
        }
    }
}
$query = $query . ";";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home | Planty</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/album.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/global_responsive.css">
    <link rel="stylesheet" href="../style/variables.css">
</head>

<body>

    <aside id="sidenav">
        <a href="javascript:void(0)" id="nav-close-btn" onclick="closeNav()">&times;</a>
        <a href="./index.html">Home</a>
        <a href="./top-plants.html">Top Plants</a>
        <a href="./statistics.html">Statistics</a>
    </aside>

    <div id="main-container">

        <!-- HEADER -->
        <header>
            <div id="menu-title-sidebar" onclick="openNav()">
                <span style="font-size: 30px;">&#9776; </span>
                <span id="menu-span"> Menu </span>
            </div>
            <div id="title-logo">
                <h1>Planty</h1>
                <h3>love for plants</h3>
            </div>
        </header>
        
        <!-- SEARCH RESULTS -->
        <div class="gray-section">
        <?php
        if ($foundFirst) {
            // it means we found at least one field completed
            $result = mysqli_query($connection, $query); // Execute query
            if($result && mysqli_num_rows($result)) {
                echo "<h2> Your Results </h2>";
                echo "<div class=\"album\">";
                while($row = mysqli_fetch_array($result)) {
                    echo "<div class=\"card\">";
                        // plant image
                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row[6] ).'"/>';
                        echo "<div>";
                            // plant name and link to plant's page (using ID)
                            echo "<h3> <a href=\"plant.php?id=" . $row[0] . "\"> <em> " . $row[1] . "</em></a></h3>";
                        echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else {
                echo "<h2> No results found. </h2>";
            }
        }
        ?>
        </div>
    </div>
    
    <script src='../js/index.js'> </script>
</body>
</html>