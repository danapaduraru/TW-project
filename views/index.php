<?php  
    require_once('../models/User.php');
    require_once('../controllers/UserController.php');
    $connection = Connection::Instance();
    
    // Select Database
    mysqli_select_db($connection, 'planty');

    if (!isset($_SESSION['login_user'])) {
        session_destroy();
     }
    else {
        header('Location: ../views/dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home | Planty</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/global_responsive.css">
    <link rel="stylesheet" href="../style/variables.css">
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
            <div class="gray-paragraph-with-pic">
                <div>
                    <div style="width: 80%;">
                        <h3> Welcome to Planty, an interesting place to discover new plants and fungi.
                        </h3>
                        <h3> Here you can: </h3>
                        <ul>
                            <li> keep track of your plant collections </li>
                            <li> search for plants using multiple filters </li>
                            <li> see top plants and statistics </li>
                        </ul>
                        <div style="margin-top: 30px; margin-left: 30px;">
                            <a 
                            class="btn btn-primary" 
                            style="display: inline-block;"
                            onclick="triggerPopUp('pop-up-register','close-register-form')">
                                Register
                            </a>
                            <a 
                            class="btn btn-secondary" 
                            style="display: inline-block;"
                            onclick="triggerPopUp('pop-up-login','close-login-form')">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
                <img src="images/home-gray-paragraph.jpg" alt="home">
            </div>
        </div>

        <!-- Pop up REGISTER FORM -->
        <div id="pop-up-register" class="pop-up-form">
            <div class="pop-up-form-content">
                <span class="close-register-form">&times;</span>
                <h2> Register with a new account </h2>
                <form action="../controllers/UserController.php" method="post" class="form-login-register">
                    <input class="input-form" type="text" placeholder="Full Name*" 
                           name="r_fullname"
                           required>
                    <input class="input-form" type="text" placeholder="Email*" 
                           name="r_email"
                           required>
                    <input class="input-form" type="password" placeholder="Password*" 
                           name="r_password"
                           required>
                    <button type="submit" class="btn btn-form btn-primary" 
                            name="r_submit">
                        Register
                    </button>
                </form>
            </div>
        </div>

        <!-- Pop up LOGIN FORM -->
        <div id="pop-up-login" class="pop-up-form">
            <div class="pop-up-form-content">
                <span class="close-login-form">&times;</span>
                <h2> Login with existing account </h2>
                <form action="../controllers/UserController.php" method="POST" class="form-login-register">
                    <input class="input-form" type="text" placeholder="Email*"
                            name = "l_email"
                    required>
                    <input class="input-form" type="password" placeholder="Password*"
                            name = "l_password"
                    required>
                    <button type="submit" class="btn btn-form btn-primary"
                            name="l_submit">
                        Login
                    </button>
                </form>
            </div>
        </div>

        <!-- SEARCH BAR -->
        <div id="div-searchbar">
            <h2> Discover new plants </h2>
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
    </div>

    <script src='../js/index.js'> </script>

</body>

</html>