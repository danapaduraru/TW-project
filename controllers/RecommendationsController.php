<?php
require_once('../models/Connection.php');

$connection = Connection::Instance();

function generate_recommendations() {
    
    global $connection, $id_user, $user_albums;
    $recommendations = array();
    
    // Go through each album to get other similar albums
    foreach($user_albums as $item) {
        $album_id = $item[0];

        // Get all plants ids for this album
        $query = "SELECT id_plant FROM plant_album where id_album=" . $album_id . ";";
        $result = mysqli_query($connection, $query);

        if($result && mysqli_num_rows($result)) {
            // if the album has any plants
            $plant_array = array();
            while($id = mysqli_fetch_array($result))
            {
                array_push($plant_array, $id[0]);
            }
            $ids = join(',', $plant_array); // to use with the IN operator

            // Get albums with the number of plants that are also found in the user's album
            $query = "SELECT p.id_album, COUNT(p.id_plant) FROM plant_album p
                    JOIN album a ON a.id = p.id_album
                    WHERE a.user_id !=" . $id_user . " AND p.id_plant IN (" . $ids . ") GROUP BY p.id_album;";
            $result = mysqli_query($connection, $query);

            if($result && mysqli_num_rows($result)) {
                $albums_array = array();
                while($row = mysqli_fetch_array($result))
                {
                    $albums_array[$row[0]] = $row[1]; // array[album_id] = plant_count;
                }
                // Sort by value so that the albums with most plants will come up first
                arsort($albums_array);
                // Get top 3 recommendations for this album
                $keys = array_keys($albums_array);
                if(count($albums_array)> 0) if(!(in_array($keys[0] , $recommendations))) array_push($recommendations, $keys[0]);
                if(count($albums_array)> 1) if(!(in_array($keys[1] , $recommendations))) array_push($recommendations, $keys[1]);
                if(count($albums_array)> 2) if(!(in_array($keys[2] , $recommendations))) array_push($recommendations, $keys[2]);
            }
        }
    }
    return $recommendations;
}

function generate_random_recommendations() {
    global $connection;
    // We will get 5 random existing albums to show the user
    $ids = array();
    $query = "SELECT id FROM album;";
    $result = mysqli_query($connection, $query);
    while($id = mysqli_fetch_array($result))
    {
        array_push($ids, $id[0]);
    }
    $random_ids = get_random_indexes(count($ids));
    $albums = array();
    foreach($random_ids as $index) {
        array_push($albums, $ids[$index]);
        if(count($albums) == 5) {
            break;
        }
    }
    return $albums;
}

function get_random_indexes($max) {
    $max--;
    $randoms = array();
    while(count($randoms) < $max) {
        $nr = rand(0,$max);
        if (!in_array($nr, $randoms)) {
            array_push($randoms, $nr);
        }
    }
    return $randoms;
}

// Select Database
mysqli_select_db($connection, 'planty');

// Get user ID
$query = "SELECT id FROM USER WHERE email='" .$_SESSION['login_user']. "';";
$result = mysqli_query($connection, $query);
$id_user = mysqli_fetch_row($result)[0];

// Get all album IDS for this user
$query = "SELECT id from album where user_id=" . $id_user . ";";
$result = mysqli_query($connection, $query);
$user_albums = array();
if($result && mysqli_num_rows($result)) {
    while($id = mysqli_fetch_array($result))
    {
        array_push($user_albums, $id);
    }
}

$recommendations_message  = "";
if(count($user_albums) == 0) {
    $recommendations = generate_random_recommendations();
    $recommendations_message  = "<h3> Recommendations are based on your albums.
    Now, you can explore other albums to see what you like! <br> <br> 
    Reload page to refresh the list. </h3>";
}
else {
    $recommendations = generate_recommendations();
}
?>