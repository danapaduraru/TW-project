<?php
    require_once('../models/Connection.php');

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
    <script type="text/javascript">
        var statistics_pdf = new jsPDF();
        
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
                title: 'Most frequent families',
                is3D:true
            };

            var chart_families = new google.visualization.PieChart(document.getElementById('top_families_piechart'));
            
            google.visualization.events.addListener(chart_families, 'ready', function () {
                btn_save_pdf.disabled = false;
                statistics_pdf.addImage(chart_families.getImageURI(), 0, 60);
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
                title: 'Top Countries',
                is3D:true
            };

            var chart_countries = new google.visualization.PieChart(document.getElementById('top_countries_piechart'));
            
            var btn_save_pdf = document.getElementById('save-pdf');
            google.visualization.events.addListener(chart_countries, 'ready', function () {
                btn_save_pdf.disabled = false;
                statistics_pdf.addImage(chart_countries.getImageURI(), 0, 160);
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
        </header>

        <!-- WELCOME SECTION -->
        <div class="gray-section">
            <!-- <h2> Diff stats </h2> -->
            <div class="charts">
                <input id="save-pdf" type="button" class="btn btn-primary" value="Export PDF" disabled style="margin-bottom: 20px;"/>
                <div id="top_families_piechart" style="width: 700px; height: 500px;"></div>                
                <div id="top_countries_piechart" style="width: 700px; height: 500px; margin-top: 20px"></div>
                <div>
                    <table style="width: 400px; height: 300px; table-layout: fixed; margin-top: 20px;" id="statistics-table">
                        <tr>
                            <th> </th>
                            <th>Total number</th>
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
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src='../js/index.js'> </script>
    <script>
        var btn_save_pdf = document.getElementById('save-pdf');

        statistics_pdf.autoTable({html:'#statistics-table', theme: 'grid'});
        
        btn_save_pdf.addEventListener('click', function () {
            statistics_pdf.save('statistics.pdf');
          }, false);
    </script>
</body>

</html>