<?php 
    require_once('../controllers/login.php');
    $connection = Connection::Instance();
                                        
    // Select Database
    mysqli_select_db($connection, 'planty'); 

     //select id from user
     $query1 = "SELECT id FROM USER WHERE email='" .$_SESSION['login_user']. "';";
     $result1 = mysqli_query($connection, $query1);
     $idFound = mysqli_fetch_row($result1)[0];
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
    <link rel="stylesheet" href="../style/album.css">
    <link rel="stylesheet" href="../style/global_responsive.css">
</head>

<body>
    <aside id="sidenav">
        <a href="javascript:void(0)" id="nav-close-btn" onclick="closeNav()">&times;</a>
        <a href="./dashboard.php">Home</a>
        <a href="./top-plants.php">Top Plants</a>
        <a href="./statistics.php">Statistics</a>
    </aside>

    <div id="main-container">

        <!-- HEADER -->
        <header>
            <div id="menu-title-sidebar" onclick="openNav()">
                <span style="font-size: 30px;">&#9776; </span>
            </div>
            <div id="title-logo">
                <h1>Planty</h1>
                <h3>love for plants</h3>
            </div>
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
        </header>

        <!-- MY DASHBOARD -->

        <!-- MY ALBUMS SECTION -->
        <div class="gray-section">
            <h2> My Albums </h2>
            <div class="album">
                <?php
                      //select name of the album
                    $query = "SELECT * FROM album WHERE user_id='" . $idFound ."';";
                    $result = mysqli_query($connection, $query);
                    while($nameFound = mysqli_fetch_array($result))
                    {
                ?>    
                        <div class="card">
                            <img src="./images/plant1.png">
                            <div>
                                <?php 
                                    echo"<h3> <a href=\"album.php?id=" . $nameFound['id'] . "\"><em>";
                                        print_r($nameFound["name"]);
                                    ?>
                            </em></a></h3>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>

        
        <!-- SEARCH BAR -->
        <h2> Discover new plants </h2>
        <div id="div-searchbar">
            <form action="search_plant.php" method="post">
                <label> Plant Name </label>
                <input name="s_name" class="input-search" type="text" placeholder="Plant Name ">
                <label> Family </label>
                <input name="s_family" class="input-search" type="text" placeholder="Family">     
                <label> Collection </label>
                <input name="s_collection" class="input-search" type="text" placeholder="Collection">
                <label> Location </label>
                <input name="s_location" class="input-search" type="text" placeholder="Location">
                <label> Collector </label>
                <input name="s_collector" class="input-search" type="text" placeholder="Collector">
                <br>
                <button name="s_submit" type="submit" class="btn-search">
                    Search <i class="fa fa-search"></i>
                </button>
            </form>
        </div>


        <!-- RECOMMENDATIONS SECTION -->
        <div class="gray-section">
            <h2> Recommendations </h2>
            <div class="album">
                <div class="card">
                    <img src="./images/plant1.png">
                    <div>
                        <h3> <a href="#"> <em>Winter Plants</em></a></h3>
                    </div>
                </div>
                <div class="card">
                    <img src="./images/plant2.png">
                    <div>
                        <h3> <a href="#"> <em>Spring Plants</em></a></h3>
                    </div>
                </div>
                <div class="card">
                    <img src="./images/plant3.png">
                    <div>
                        <h3> <a href="#"> <em>Therapeutic Plants</em></a></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pop up Add Album FORM -->
        <div id="pop-up-addAlbum" class="pop-up-form">
            <div class="pop-up-form-content">
                <span class="close-addAlbum-form">&times;</span>
                <h3> Add a new album to your list </h3>
                <form action="../controllers/album.php" method="POST" class="form-addAlbum">
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

    </div> <!-- main-container -->

    <script src='../js/index.js'> </script>

</body>

</html>