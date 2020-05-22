<?php
    require_once('../models/Connection.php');

    $connection = Connection::Instance();
                                        
    // Select Database
    mysqli_select_db($connection, 'planty');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home | Planty</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/variables.css">
    <link rel="stylesheet" href="../style/top-plants.css">
    <link rel="stylesheet" href="../style/global_responsive.css">
    <link rel="stylesheet" href="../style/statistics.css">
</head>

<body>

    <aside id="sidenav">
        <a href="javascript:void(0)" id="nav-close-btn" onclick="closeNav()">&times;</a>
        <a href="./index.php">Home</a>
        <a href="./top-plants.php">Top Plants</a>
        <a href="./statistics.php">Statistics</a>
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

        <!-- WELCOME SECTION -->
        <div class="gray-section">
            <div style="margin: auto; margin-top: 3em;">
                <h2> Most popular plants </h2>
                <table style="margin-top: 2em; text-align: center;">
                <tr>
                    <th> Number </th>
                    <th> Name </th>
                    <th> Times collected </th>
                </tr>
                <?php 
                    $counter = 1;
                    //most popular plants
                    $query = "SELECT p.name, COUNT(a.id_plant) FROM plant p JOIN plant_album a on p.id=a.id_plant GROUP BY a.id_plant ORDER BY COUNT(a.id_plant) DESC LIMIT 10;";
                    $result = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($result)){
                ?>
                        <tr>
                            <td> <?php echo $counter; $counter++; ?> </td>
                            <td> <?php echo $row[0]; ?> </td>
                            <td> <?php echo $row[1]; ?></td>
                        </tr><?php }?>
                </table>
                
                <div style="margin: 2em;"> 
                    <img src="images/rss-feed-icon.png" style="width: 30px;">
                    <a href="#" style="color: var(--light-accent);"> RSS Feed </a>
                </div>
            </div>
        </div>
    </div>

    <script src='../js/index.js'> </script>

</body>

</html>