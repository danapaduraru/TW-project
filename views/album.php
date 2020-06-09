<?php 
    require_once('../models/User.php');
    require_once('../controllers/UserController.php');
    $connection = Connection::Instance();
                                        
    // Select Database
    mysqli_select_db($connection, 'planty'); 

    $ida = $_GET['id'];
    $query = 'SELECT * from album WHERE id=' . $ida . ';';

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
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/variables.css">
    <link rel="stylesheet" href="../style/album.css">
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
                <span id="menu-span"> Menu </span>
            </div>
            <div id="title-logo">
                <h1>Planty</h1>
                <h3>love for plants</h3>
            </div>
        </header>

        <!-- WELCOME SECTION -->
        <div class="gray-section">
            <h2>
            <?php
                if($result && mysqli_num_rows($result)) {
                 // daca exista albumul cu acest ID, afisam titlul acestuia
                $row = mysqli_fetch_array($result);
                echo $row[1];
                }
            ?></h2>
            <h3>
            <?php
                if($result && mysqli_num_rows($result)) {
                 // daca exista albumul cu acest ID afisam si descrierea
                echo $row[2], "<br><br>";
                }
        
                    //select full name from user
                    $query = "SELECT u.fullname FROM USER u JOIN album a ON u.id=a.user_id WHERE a.id='" .$ida. "';";
                    $result = mysqli_query($connection, $query);
                    $full_name = mysqli_fetch_row($result)[0];
                    echo " Created by ", $full_name; 
                ?>

                <?php 

                    //select id of all albums of a user
                    $query = "SELECT a.id FROM album a JOIN plant_album pa on a.id=pa.id_album WHERE a.id='" . $ida . "' AND a.user_id='" .$id_user. "';";
                    $result = mysqli_query($connection, $query);
                    $ids = mysqli_fetch_row($result);

                    if($ids){

                        echo "<div class=\"delete_album\">";
                        echo "<div id=\"pop-up-deleteAlbum\" class=\"pop-up-form\">";
                           echo "<div class=\"pop-up-form-content\">";
                                echo "<span class=\"close-deleteAlbum-form\">&times;</span>";
                                echo "<h3> Are you sure that you want to delete this album? </h3>";
                                echo "<form action=\"../controllers/delete_album.php\" method=\"POST\" class=\"form-deleteAlbum\">";
                                    echo "<input type=\"hidden\" name=\"album_id_del\" value=\"<?php echo htmlspecialchars($row[0]); ?>\" />";
                                        echo "<button type=\"submit\" class=\"btn btn-form btn-primary\"";
                                                echo "name=\"a_submit_del\">";
                                                echo "Delete album";
                                        echo "</button>";
                                echo "</form>";
                            echo "</div>";
                        echo "</div>";
                        echo "<button type=\"submit\" class=\"btn btn-form btn-primary delete_alb\" onclick=\"triggerPopUp('pop-up-deleteAlbum','close-deleteAlbum-form')\">";
                            echo "Delete Album";
                        echo "</button>";

                        echo "<div id=\"pop-up-addAlbum\" class=\"pop-up-form\">";
                            echo "<div class=\"pop-up-form-content\">";
                                echo "<span class=\"close-addAlbum-form\">&times;</span>";
                                echo "<h3> Delete a plant from your album </h3>";
                                echo "<form action=\"../controllers/delete_plant.php\" method=\"POST\" class=\"form-addAlbum\">";
                                    echo "<input type=\"hidden\" name=\"a_album_id\" value=\"<?php echo htmlspecialchars($row[0]); ?>\" /> ";
                                    echo "<label for=\"plants\">Choose a plant:</label>";
                                    echo "<select style=\"margin-top: 30px\" id=\"plant\" name=\"plant\">";

                                    // Select name of the plants that belong to current album"

                                            $query = "SELECT p.name FROM plant p JOIN plant_album pa on p.id = pa.id_plant WHERE pa.id_album=" . $ida .";";
                                            $result = mysqli_query($connection, $query);
                                            while($plant = mysqli_fetch_array($result))
                                            { 
                                                echo "<option>"; 
                                                    print_r($plant['name']); 
                                                echo "</option>";     
                                            } 
                                    echo "</select>";
                                    echo "<button type=\"submit\" class=\"btn btn-form btn-primary\"";
                                    echo "name=\"pl_submit\">";
                                    echo "Delete plant";
                                    echo "</button>";
                                echo "</form>";
                            echo "</div>";
                        echo "</div>";

                echo "<button type=\"submit\" class=\"btn btn-form btn-primary delete_plant\" onclick=\"triggerPopUp('pop-up-addAlbum','close-addAlbum-form')\">";
                            echo "Delete Plant";
                        echo "</button>";
            echo "</div>";
                    }
                ?>

            </h3>
            <!-- PLANT ALBUM -->
            <div class="album">
                <?php
                    // selectam numele acelor plante care apartin albumului selectat de noi
                    $query = "SELECT * FROM plant p join plant_album a on p.id = a.id_plant where id_album='".$ida ."';";
                    $result = mysqli_query($connection, $query);
                    while($nameFound = mysqli_fetch_array($result))
                    {
                ?> 
                        <div class="card">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $nameFound['image'] ).'"/>'; ?>
                            <div>
                                <h3> <?php
                                        echo"<h3> <a href=\"plant.php?id=" . $nameFound['id_plant'] . "&id_album=" . $row[0] . "\"><em>"; 
                                        print_r($nameFound['name']); ?></em></a></h3>
                            </div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>

    <script src='../js/index.js'> </script>

</body>

</html>