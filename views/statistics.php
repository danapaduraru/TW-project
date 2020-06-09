<?php
require_once('../models/Connection.php');
require_once('../controllers/UserController.php');

$connection = Connection::Instance();

// Select Database
mysqli_select_db($connection, 'planty');

$query_families = "SELECT family, count(*) from plant group by family;";
$result_families = mysqli_query($connection, $query_families);

$query_location = "SELECT location, COUNT(*) FROM plant WHERE location not like '-' GROUP BY location;";
$result_location = mysqli_query($connection, $query_location);
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
    
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <!-- GENERATE PIECHARTS --> 
    <script type="text/javascript">
        var stats_pdf = new jsPDF();
        
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartFamilies);

        function drawChartFamilies() {
            var data = google.visualization.arrayToDataTable([  
                  ['Family', 'Number of plants'], 
                  <?php  
                  while($row = mysqli_fetch_array($result_families))
                  {  
                       echo "['".$row[0]."', ".$row[1]."],";  
                  }  
                  ?>  
            ]);

            var options = {
                is3D:true
            };

            var chart_families = new google.visualization.PieChart(document.getElementById('top_families_piechart'));
            
            google.visualization.events.addListener(chart_families, 'ready', function () {
                btn_save_pdf.disabled = false;
                stats_pdf.addPage();
                stats_pdf.text(20, 20, 'Most frequent plant families');
                stats_pdf.addImage(chart_families.getImageURI(), 0, 30);
              });
            
            chart_families.draw(data, options);
        }

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartCountries);

        function drawChartCountries() {
            var data = google.visualization.arrayToDataTable([  
                ['Country', 'Number of Plants'], 
                <?php  
                while($row = mysqli_fetch_array($result_location))
                {  
                    echo "['".$row[0]."', ".$row[1]."],";  
                }  
                ?>  
            ]);

            var options = {
                is3D:true
            };

            var chart_countries = new google.visualization.PieChart(document.getElementById('top_countries_piechart'));
            
            var btn_save_pdf = document.getElementById('save-pdf');
            google.visualization.events.addListener(chart_countries, 'ready', function () {
                btn_save_pdf.disabled = false;
                stats_pdf.text(20, 140, 'Plants by countries');
                stats_pdf.addImage(chart_countries.getImageURI(), 0, 150);
              });
            chart_countries.draw(data, options);
        }
    </script>
    
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

        <div class="stats-container">
            <div style="margin: 2em;"> <span> <b> Click to export this data as </b> </span> 
            <input id="save-pdf" type="button" value="PDF" disabled/> <span> <b> or </b> </span>
            <form action="../controllers/ExportCSVController.php" method="post" style="display:inline;">
                <input id="save-csv" type="submit" value="CSV"  name="save-csv"/>
            </form>
            </div>
            
            <div class="stats">
                
                <div class="charts">
                    <div>
                        <h2> Most frequent plant families </h2>
                        <!-- TOP FAMILIES PIECHART --> 
                        <div id="top_families_piechart" style="width: 600px; height: 400px;"></div> 
                    </div>
                    <div>
                        <h2> Plants by countries </h2>
                        <!-- TOP COUNTRIES PIECHART --> 
                        <div id="top_countries_piechart" style="width: 600px; height: 400px;"></div>
                    </div>
                    
                </div>
                
                <div class="stats-tables">
                    <!-- TOP ALBUMS --> 
                    <div>
                        <h2> Comprehensive albums </h2>
                        <table id="albums-table">
                            <tr>
                                <th> User </th>
                                <th> Album </th>
                                <th> Number of plants </th>
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
                            </tr><?php } ?>
                        </table>
                    </div>

                    <!-- TOP ALBUM CREATORS -->
                    <div>
                        <h2> Top album creators </h2>
                        <table id="creators-table">
                            <tr>
                                <th> User </th>
                                <th> Number of albums </th>
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
                        </table>
                    </div>

                    <!-- STATISTICS -->
                    <div>
                        <h2> Planty statistics </h2>
                        <table id="stats-table">
                            <tr>
                                <th> </th>
                                <th>Total number</th>
                            </tr>
                            <tr> 
                                <th> Users </th>
                                <td>
                                    <?php 
                                        $query = "SELECT COUNT(*) FROM user;";
                                        $result = mysqli_query($connection, $query);
                                        $row = mysqli_fetch_array($result);
                                        echo $row[0];
                                    ?>
                                </td>
                            </tr>
                            <tr> 
                                <th> Albums </th>
                                <td>
                                    <?php 
                                        $query = "SELECT COUNT(*) FROM album;";
                                        $result = mysqli_query($connection, $query);
                                        $row = mysqli_fetch_array($result);
                                        echo $row[0];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th> Plants </th>
                                <td>
                                    <?php 
                                        $query = "SELECT COUNT(*) FROM plant;";
                                        $result = mysqli_query($connection, $query);
                                        $row = mysqli_fetch_array($result);
                                        echo $row[0];
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
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
    <script>
        var btn_save_pdf = document.getElementById('save-pdf');
        stats_pdf.setFontSize(14);

        stats_pdf.text(20, 20, 'Planty Statistics');
        stats_pdf.autoTable({html:'#stats-table', theme: 'grid', startY: 30});
        
        stats_pdf.text(20, 70, 'Comprehensive albums');
        stats_pdf.autoTable({html:'#albums-table', theme: 'grid', startY: 80});
        
        stats_pdf.text(20, 170, 'Top album creators');
        stats_pdf.autoTable({html:'#creators-table', theme: 'grid', startY: 180});
        
        btn_save_pdf.addEventListener('click', function () {
            stats_pdf.save('statistics.pdf');
        }, false);
    </script>
</body>

</html>