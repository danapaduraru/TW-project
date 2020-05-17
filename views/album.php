<?php 
    require_once('../controllers/login.php');
    $connection = Connection::Instance();
                                        
    // Select Database
    mysqli_select_db($connection, 'planty'); 

    $id = $_GET['id'];
    $query = 'SELECT * from album WHERE id=' . $id . ';';

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
                echo $row[2];
                }
            ?></h3>
            <!-- PLANT ALBUM -->
            <div class="album">
                <?php
                    // selectam numele acelor plante care apartin albumului selectat de noi
                    $query = "SELECT * FROM plant p join plant_album a on p.id = a.id_plant where id_album='".$id ."';";
                    $result = mysqli_query($connection, $query);
                    while($nameFound = mysqli_fetch_array($result))
                    {
                ?> 
                        <div class="card">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $nameFound['image'] ).'"/>'; ?>
                            <div>
                                <h3> <?php
                                        echo"<h3> <a href=\"plant.php?id=" . $nameFound['id'] . "\"><em>"; 
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