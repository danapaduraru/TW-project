<?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");

    require_once('../models/Connection.php');

    $connection = Connection::Instance();
                                        
    // Select Database
    mysqli_select_db($connection, 'planty');

    //comprehensive albums
    $query = "SELECT u.fullname, a.name, COUNT(p.id_album) FROM user u join album a on u.id=a.user_id join plant_album p on a.id = p.id_album GROUP BY p.id_album ORDER BY COUNT(p.id_album) DESC LIMIT 10;";
    $result = mysqli_query($connection, $query);

    //most popular plants
    $query1 = "SELECT p.name, COUNT(a.id_plant) FROM plant p JOIN plant_album a on p.id=a.id_plant GROUP BY a.id_plant ORDER BY COUNT(a.id_plant) DESC LIMIT 10;";
    $result1 = mysqli_query($connection, $query1);

    //top albums creators
    $query2 = "SELECT u.fullname, COUNT(a.user_id) FROM user u join album a on u.id = a.user_id GROUP BY a.user_id ORDER BY COUNT(a.user_id) DESC LIMIT 10;";
    $result2 = mysqli_query($connection, $query2);

    $base_url = "http://localhost/TW-project/views/rsstop.php";

    echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
    echo "<rss version='2.0'>".PHP_EOL;
    echo "<channel>".PHP_EOL;


    echo "<title>Top Plants feed | RSS</title>".PHP_EOL;
    echo "<link>".$base_url."index.php</link>".PHP_EOL;
    echo "<description>Top plants, albums and users from PlanOr</description>".PHP_EOL;
    echo "<language>en-us</language>".PHP_EOL;
    echo "This is a &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; lot of space.";

        echo "<title>Comprehensive Albums</title>".PHP_EOL;

        while($row = mysqli_fetch_array($result)){
            echo "<item xmlns:dc='ns:1'>".PHP_EOL;
            echo "<userName>".$row[0]."</userName>".PHP_EOL;
            echo "<albumName>".$row[1]."</albumName>".PHP_EOL;
            echo "<plantNumber>".$row[2]."</plantNumber>".PHP_EOL;
            echo "</item>".PHP_EOL;
        }

        echo "<title>Most popular plants</title>".PHP_EOL;

        while($row = mysqli_fetch_array($result1)){
            echo "<item xmlns:dc='ns:1'>".PHP_EOL;
            echo "<plantName>".$row[0]."</plantName>".PHP_EOL;
            echo "<plantNumber>".$row[1]."</plantNumber>".PHP_EOL;
            echo "</item>".PHP_EOL;
        }

        echo "<title>Top album creators</title>".PHP_EOL;

        while($row = mysqli_fetch_array($result2)){
            
            echo "<item xmlns:dc='ns:1'>".PHP_EOL;
            echo "<userName>".$row[0]."</userName>".PHP_EOL;
            echo "<albumNumber>".$row[1]."</albumNumber>".PHP_EOL;
            echo "</item>".PHP_EOL;
        }
    

    echo '</channel>'.PHP_EOL;
    echo '</rss>'.PHP_EOL;
?>