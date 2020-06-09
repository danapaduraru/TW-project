<?php
require_once('../models/User.php');
require_once('../controllers/UserController.php');
$connection = Connection::Instance();

// Select Database
mysqli_select_db($connection, 'planty');

// if (isset($_SESSION['login_user'])) {
//     session_destroy();
// }

// Get plant ID from URL
$id = $_GET['id'];

// Get album's ID from URL
if (isset($_GET['id_album'])) {
    $id_album = $_GET['id_album'];
}

$query = 'SELECT * from plant WHERE id=' . $id . ';';

$result = mysqli_query($connection, $query); // Execute query

    if(isset($_SESSION['login_user'])){
        //select id from user
        $query1 = "SELECT id FROM USER WHERE email='" .$_SESSION['login_user']. "';";
        $result1 = mysqli_query($connection, $query1);
        $id_user = mysqli_fetch_row($result1)[0];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home | Planty</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/variables.css">
    <link rel="stylesheet" href="../style/top-plants.css">
    <link rel="stylesheet" href="../style/plant.css">
    <link rel="stylesheet" href="../style/global_responsive.css">
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

        <!-- GRAY SECTION -->
        <div class="gray-section">
            <div class="card">
                <div class="card-info">
                    <?php
                    if($result && mysqli_num_rows($result)) {
                        // daca exista planta cu acest ID
                        $row = mysqli_fetch_array($result);
                    ?>
                        <table>
                        <tr>
                            <th> Scientific Name </th>
                            <td><em> <?php echo $row[1] ?> </em></td>
                        </tr>
                        <tr>
                            <th> Family </th>
                            <td><em> <?php echo $row[2] ?> </em></td>
                        </tr>
                        <tr>
                            <th> Collection </th>
                            <td><em> <?php echo $row[3] ?> </em></td>
                        </tr>
                        <tr>
                            <th> Location </th>
                            <td><em> <?php echo $row[5] ?>  </em></td>
                        </tr>
                        <tr>
                            <th> Collector </th>
                            <td><em> <?php echo $row[4] ?> </em></td>
                        </tr>
                        </table>
                        <?php
                            if(isset($_SESSION['login_user'])){ ?>
                                <a href="#" class="btn btn-primary"
                                    onclick="triggerPopUp('pop-up-addAlbum','close-addAlbum-form')">
                                    Add to album
                                </a>
                            <?php } ?>
                </div>
                    <?php
                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $row[6] ).'"/>';
                    }
                    else {
                        echo "<h2> There is no plant with this ID. </h2>";
                    }
                    ?>
            </div>
        </div>

        <div id="pop-up-addAlbum" class="pop-up-form">
            <div class="pop-up-form-content">
                <span class="close-addAlbum-form">&times;</span>
                <h3> Add a new plant to your albums </h3>
                <form action="../controllers/add_plant_to_album.php" method="POST" class="form-addAlbum">
                    <input type="hidden" name="p_plant_id" value="<?php echo htmlspecialchars($row[0]); ?>" /> 
                    <label for="albums">Choose an album:</label>
                    <select style="margin-top: 30px" id="album" name="album">
                        <?php
                            // Select name of the albums that belong to the user and do not have this plant
                            $query = "SELECT id, name FROM album WHERE user_id=" . $id_user . 
                                    " AND id NOT IN ( SELECT id_album from plant_album WHERE id_plant=" . $row[0] . ");";
                            $result = mysqli_query($connection, $query);
                            while($album = mysqli_fetch_array($result))
                            { 
                            ?>
                                <option><?php print_r($album['name']); ?></option>     
                            <?php 
                            } 
                            ?>
                    </select>
                    <button type="submit" class="btn btn-form btn-primary"
                    name="p_submit">
                        Add to Album
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src='../js/index.js'> </script>

</body>

</html>