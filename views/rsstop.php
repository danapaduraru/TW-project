<?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");

    require_once('../models/Connection.php');

    $connection = Connection::Instance();
                                        
    // Select Database
    mysqli_select_db($connection, 'planty');

    //most popular plants
    $query1 = "SELECT p.name, COUNT(a.id_plant) FROM plant p JOIN plant_album a on p.id=a.id_plant GROUP BY a.id_plant ORDER BY COUNT(a.id_plant) DESC LIMIT 10;";
    $result1 = mysqli_query($connection, $query1);

    $base_url = "http://localhost/TW-project/views/rsstop.php";

    echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
    echo "<rss version='2.0'>".PHP_EOL;
    echo "<channel>".PHP_EOL;


    echo "<title>Top Plants feed | RSS</title>".PHP_EOL;
    echo "<link>".$base_url."index.php</link>".PHP_EOL;
    echo "<description>Top plants, albums and users from PlanOr</description>".PHP_EOL;
    echo "<language>en-us</language>".PHP_EOL;
    echo "This is a &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; lot of space.";

        echo "<title>Most popular plants</title>".PHP_EOL;

        while($row = mysqli_fetch_array($result1)){
            echo "<item xmlns:dc='ns:1'>".PHP_EOL;
            echo "<plantName>".$row[0]."</plantName>".PHP_EOL;
            echo "<plantNumber>".$row[1]."</plantNumber>".PHP_EOL;
            echo "</item>".PHP_EOL;
        }

    echo '</channel>'.PHP_EOL;
    echo '</rss>'.PHP_EOL;
?>