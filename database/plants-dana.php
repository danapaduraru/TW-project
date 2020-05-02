<?php 
require_once('../models/Connection.php');

function insertPlant($url, $name, $family, $collection, $collector, $location) {
    $connection = Connection::Instance();
    // Select Database
    mysqli_select_db($connection, 'planty');
    // Get image from URL
    $imageData = file_get_contents($url);
    // Escape special characters in a string for use in SQL query
    $imageBlob = mysqli_real_escape_string($connection, $imageData);
    
    $query = "INSERT INTO plant(name, family, collection, collecter, location, image) VALUES ('"
    . $name . "', '"
    . $family . "', '"
    . $collection . "', '"
    . $collector . "', '"
    . $location . "', '"
    . $imageBlob . "');";
    
    // Execute query
    if (!($connection->query($query)))
        echo mysqli_error($connection);
    else
        echo 'Plant inserted to DB.';
}

$url = 'http://www.kew.org/herbcatimg/489598.jpg';
$name = "Acorus gramineus";
$family = "Acoraceae ";
$collection = "RBG 436";
$collector = "Cope, T.A. ";
$location = "Zhejiang";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/272192.jpg';
$name = "Cleome amblyocarpa";
$family = "Cleomaceae";
$collection = "436";
$collector = "Parsa, A. ";
$location = "Iran, Islamic Republic of. ";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/1020705.jpg';
$name = "Cleome arenitensis";
$family = "Cleomaceae";
$collection = "4725 ";
$collector = "Parsa, A. ";
$location = "Australia";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/912483.jpg';
$name = "Cleome bundeica";
$family = "Cleomaceae";
$collection = "5153  ";
$collector = "Short, P.S.";
$location = "Australia";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/272133.jpg';
$name = "Cleome coluteoides";
$family = "Cleomaceae";
$collection = "5153  ";
$collector = "Bunge";
$location = "Iran, Islamic Republic of. ";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/272180.jpg';
$name = "Cleome glaucescens";
$family = "Cleomaceae";
$collection = "402";
$collector = "Brandegee, J.S.";
$location = "Mexico";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/272183.jpg';
$name = "Cleome heratensis";
$family = "Cleomaceae";
$collection = "s.n.";
$collector = "Brandegee, J.S.";
$location = "Afghanistan";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/272190.jpg';
$name = "Cleome iberica";
$family = "Cleomaceae";
$collection = "s.n.";
$collector = "Haussknecht, C.";
$location = "Turkey";

insertPlant($url, $name, $family, $collection, $collector, $location);

// 10: 

$url = 'http://www.kew.org/herbcatimg/912489.jpg';
$name = "Cleome insolata";
$family = "Cleomaceae";
$collection = "s.n.";
$collector = "Mayo, S.J.; Madison, M.T.";
$location = "Turkey";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/337417.jpg';
$name = "Hydrocera triflora";
$family = "Balsaminaceae";
$collection = "s.n.";
$collector = "Proshad, K.";
$location = "Sri Lanka";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/307745.jpg';
$name = "Impatiens acuminata";
$family = "Balsaminaceae";
$collection = "1796";
$collector = "John D";
$location = "India";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/298430.jpg';
$name = "Impatiens alborosea";
$family = "Balsaminaceae";
$collection = "332 ";
$collector = "John D";
$location = "India";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/315836.jpg';
$name = "Impatiens alborubra";
$family = "Balsaminaceae";
$collection = "6073";
$collector = "John D";
$location = "Indonesia";

insertPlant($url, $name, $family, $collection, $collector, $location);

// 15:

$url = 'http://www.kew.org/herbcatimg/165678.jpg';
$name = "Abobra tenuifolia";
$family = "Cucurbitaceae";
$collection = "6674";
$collector = "Hawkes";
$location = "Peru";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/134723.jpg';
$name = "Abobra horrida";
$family = "Cucurbitaceae";
$collection = "332 ";
$collector = "Mogg, A.O.G.";
$location = "South Africa";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/868064.jpg';
$name = "Biswarea tonglensis";
$family = "Cucurbitaceae";
$collection = "27357";
$collector = "Clarke, C.B. ";
$location = "India";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/340487.jpg';
$name = "Bolbostemma biglandulosum";
$family = "Cucurbitaceae";
$collection = "9390A";
$collector = "Henry, A. ";
$location = "China";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/753319.jpg';
$name = "Cayaponia bonariensis";
$family = "Cucurbitaceae";
$collection = "563";
$collector = "Weir, J.";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

// 20:

$url = 'http://www.kew.org/herbcatimg/755359.jpg';
$name = "Ceratosanthes hilariana";
$family = "Cucurbitaceae";
$collection = "563";
$collector = "Irwin, H.S.";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/84196.jpg';
$name = "Diospyros abyssinica";
$family = "Ebenaceae";
$collection = "1870";
$collector = "Beccari, O.";
$location = "Ethiopia";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/85582.jpg';
$name = "Diospyros acris";
$family = "Ebenaceae";
$collection = "1870";
$collector = "Vollesen, K.";
$location = "Tanzania";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/379135.jpg';
$name = "Diospyros urdanetensis";
$family = "Ebenaceae";
$collection = "13435 ";
$collector = "Vollesen, K.";
$location = "Philippines";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/106679.jpg';
$name = "Diospyros uzungwaensis";
$family = "Ebenaceae";
$collection = "NG120";
$collector = "Vollesen, K.";
$location = "Tanzania";

insertPlant($url, $name, $family, $collection, $collector, $location);

// 25:

$url = 'http://www.kew.org/herbcatimg/317699.jpg';
$name = "Alsodeia";
$family = "Ebenaceae";
$collection = "746";
$collector = "Jessup, L.W.";
$location = "Australia";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/156706.jpg';
$name = "Agatea veillonii";
$family = "Violaceae";
$collection = "NG120";
$collector = "Caldwell, E.";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/154496.jpg';
$name = "Hybanthus acalyphoides ";
$family = "Violaceae";
$collection = "23944";
$collector = "Caldwell, E.";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/156655.jpg';
$name = "Melicytus micranthus";
$family = "Violaceae";
$collection = "166";
$collector = "Caldwell, E.";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/1034526.jpg';
$name = "Noisettia longifolia ";
$family = "Violaceae";
$collection = "166";
$collector = "Cunningham, A.";
$location = "New Zealand";

insertPlant($url, $name, $family, $collection, $collector, $location);

// 30:

$url = 'http://www.kew.org/herbcatimg/277554.jpg';
$name = "Melicytus micranthus";
$family = "Violaceae";
$collection = "166";
$collector = "Cunningham, A.";
$location = "New Zealand";

insertPlant($url, $name, $family, $collection, $collector, $location);

?>

