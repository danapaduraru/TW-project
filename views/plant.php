<?php
require_once('../models/User.php');
require_once('../controllers/login.php');
$connection = Connection::Instance();

// Select Database
mysqli_select_db($connection, 'planty');

// if (isset($_SESSION['login_user'])) {
//     session_destroy();
// }

// Get ID from URL
$id = $_GET['id'];
$query = 'SELECT * from plant WHERE id=' . $id . ';';

$result = mysqli_query($connection, $query); // Execute query

    if(isset($_SESSION['login_user'])){
        //select id from user
        $query1 = "SELECT id FROM USER WHERE email='" .$_SESSION['login_user']. "';";
        $result1 = mysqli_query($connection, $query1);
        $idFound = mysqli_fetch_row($result1)[0];
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
    <link rel="stylesheet" href="../style/variables.css">
    <link rel="stylesheet" href="../style/top-plants.css">
    <link rel="stylesheet" href="../style/plant.css">
    <link rel="stylesheet" href="../style/global_responsive.css">
</head>

<body>

    <aside id="sidenav">
        <a href="javascript:void(0)" id="nav-close-btn" onclick="closeNav()">&times;</a>
        <a href="./index.php">Home</a>
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
                        <a href="#" class="btn btn-primary"
                            onclick="triggerPopUp('pop-up-addAlbum','close-addAlbum-form')">
                            Add to album
                        </a>
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
                <form action="../controllers/plant.php" method="POST" class="form-addAlbum">
                <label for="albums">Choose an album:</label>
                    <select id="album" name="album">
                        <?php
                        //select name of the album
                            $query = "SELECT * FROM album WHERE user_id='" . $idFound ."';";
                            $result = mysqli_query($connection, $query);
                            while($nameFound = mysqli_fetch_array($result))
                            {
                            ?>
                                <option><?php print_r($nameFound['name']); ?></option>     
                            <?php }?>
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