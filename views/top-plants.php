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
            <!-- <h2> Top Comprehensive Albums</h2> -->
            <!-- <h3> All time popular plants (that appear in most albums) </h3> -->
            <div class="tables" style="margin-top: 40px;">
                <!--comprehensive albums -->
                 <!--most popualr albums-->
                <!-- <h2> Most popular albums</h2> -->
                <div><table style="margin-top: 15px;">
                    <tr><b>Most popular plants</b></tr>
                    <tr>
                        <th> Plant name </th>
                        <th> Plants number </th>
                    </tr>
                    <?php 
                        //most popular plants
                        $query = "SELECT p.name, COUNT(a.id_plant) FROM plant p JOIN plant_album a on p.id=a.id_plant GROUP BY a.id_plant ORDER BY COUNT(a.id_plant) DESC LIMIT 10;";
                        $result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($result)){
                    ?>
                            <tr>
                                <td> <?php echo $row[0]; ?> </td>
                                <td> <?php echo $row[1]; ?></td>
                            </tr><?php }?>
                </table></div>
                
                <div><table style="margin-top: 15px;">
                    <tr><b>Comprehensive albums</b></tr>
                    <tr>
                        <th> User name </th>
                        <th> Album name </th>
                        <th> Plants number </th>
                    </tr>
                    <?php 
                        //comprehensive albums
                        $query = "SELECT u.fullname, a.name, COUNT(p.id_album) FROM user u join album a on u.id=a.user_id join plant_album p on a.id = p.id_album GROUP BY p.id_album ORDER BY COUNT(p.id_album) DESC LIMIT 10;";
                        $result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($result)){
                    ?>
                            <tr>
                                <td> <?php echo $row[0]; ?> </td>
                                <td> <?php echo $row[1]; ?></td>
                                <td> <?php echo $row[2]; ?> </td>
                            </tr><?php }?>
                </table></div>
            
                <!--top albums creator-->
                <!-- <h2> Top albums creator</h2> -->
                <div><table style="margin-top: 15px;">
                    <tr><b>Top album creators</b></tr>
                    <tr>
                        <th> User name </th>
                        <th> Albums number </th>
                    </tr>
                    <?php 
                        //top albums creators
                        $query = "SELECT u.fullname, COUNT(a.user_id) FROM user u join album a on u.id = a.user_id GROUP BY a.user_id ORDER BY COUNT(a.user_id) DESC LIMIT 10;";
                        $result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($result)){
                    ?>
                            <tr>
                                <td> <?php echo $row[0]; ?> </td>
                                <td> <?php echo $row[1]; ?> </td>
                            </tr><?php }?>
                </table></div>
            </div>
        </div>
    </div>

    <script src='../js/index.js'> </script>

</body>

</html>