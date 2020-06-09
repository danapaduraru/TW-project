<?php
    require_once('../models/Connection.php');
    require_once('../controllers/UserController.php');

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
    <link rel="stylesheet" href="../style/dashboard.css">
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

            <?php
            if(isset($_SESSION['login_user']))
            {
                ?>
            <div class="dropdown" id="account">
                <button class="dropbtn">
                    <h3><?php 
                            //select full name from user
                            $query1 = "SELECT fullname FROM USER WHERE email='" .$_SESSION['login_user']. "';";
                            $result1 = mysqli_query($connection, $query1);
                            $nameFound = mysqli_fetch_row($result1)[0];
                            echo $nameFound; ?>

                        <i class="fa fa-sort-desc fa "></i>
                    </h3>
                </button>
                    <div class="dropdown-content">
                        <a class="addAlbum" 
                        onclick="triggerPopUp('pop-up-addAlbum','close-addAlbum-form')">
                            <font size="2">
                                <b>Add Album </b>
                                <i class="fa fa-plus fa-sm"></i>
                            </font>
                        </a>
                        <!-- <a href="album.html" class="addAlbum" ><font size="2"><b>My Albums </b><i class="fa fa-folder-open fa-xs"></font></i></a> -->
                        <button class="logoutbtn" onclick="location.href= '../controllers/logout.php'" type="button">
                            <b>Logout </b> 
                            <i class="fa fa-sign-out fa-sm "></i>
                        </button>
                    </div>
            </div> 
            <?php } ?>
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
                    <a href="./rsstop.php" style="color: var(--light-accent);"> RSS Feed
                    <img src="images/rss-feed-icon.png" style="width: 40px;" alt="rss">
                    </a>
                </div>
            </div>
        </div>
        <div id="pop-up-addAlbum" class="pop-up-form">
            <div class="pop-up-form-content">
                <span class="close-addAlbum-form">&times;</span>
                <h3> Add a new album to your list </h3>
                <form action="../controllers/add_album.php" method="POST" class="form-addAlbum">
                    <input class="input-form" type="text" placeholder="Name*"
                    name="a_name"
                    required>
                    <input class="input-form" type="text" placeholder="Short description*"
                    name="a_description"
                    required>
                    <button type="submit" class="btn btn-form btn-primary"
                    name="a_submit">
                        Add Album
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src='../js/index.js'> </script>

</body>

</html>