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
    
    $query = "INSERT INTO plant(name, family, collection, collector, location, image) VALUES ('"
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

$url = 'http://www.kew.org/herbcatimg/261022.jpg';
$name = "Azolla cristata";
$family = "Azollaceae";
$collection = "817";
$collector = "Spruce  ";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/744230.jpg';
$name = "Azolla pinnata";
$family = "Azollaceae ";
$collection = "134 ";
$collector = "Brown, R. ";
$location = "Australia";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/345828.jpg';
$name = "Buxus harlandii";
$family = "Buxaceae";
$collection = "322";
$collector = "Hance, H.F.";
$location = "Hong Kong";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/706542.jpg';
$name = "Buxus";
$family = "Buxaceae";
$collection = "7978";
$collector = "Wallich, N.";
$location = "India";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/240993.jpg';
$name = "Buxus glomerata";
$family = "Buxaceae";
$collection = "1676";
$collector = "Wright, C.";
$location = "Cuba";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/344217.jpg';
$name = "Buxus cochinchinensis";
$family = "Buxaceae";
$collection = "s.n";
$collector = "Pierre, J.B.L.";
$location = "Vietnam";

insertPlant($url, $name, $family, $collection, $collector, $location);


$url = 'http://www.kew.org/herbcatimg/200795.jpg';
$name = "Buxus benguellensis";
$family = "Buxaceae";
$collection = "4901";
$collector = "Gossweiler, J.";
$location = "Angola";

insertPlant($url, $name, $family, $collection, $collector, $location);


$url = 'http://www.kew.org/herbcatimg/240994.jpg';
$name = "Buxus cubana";
$family = "Buxaceae";
$collection = "1840";
$collector = "Linden";
$location = "Cuba";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/272192.jpg';
$name = "Cleome amblyocarpa";
$family = "Cleomaceae";
$collection = "343";
$collector = "Parsa, A.";
$location = "Iran";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/1020705.jpg';
$name = "Cleome arenitensis";
$family = "Cleomaceae";
$collection = "4725";
$collector = "Fryxell, P.A.;";
$location = "Australia";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/912484.jpg';
$name = "Cleome linophylla ";
$family = "Cleomaceae";
$collection = "5138";
$collector = "Short, P.S.";
$location = "Australia";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/699793.jpg';
$name = "Gynandropsis pentaphylla";
$family = "Cleomaceae";
$collection = "6964";
$collector = "Wallich, N.";
$location = "Myanmar";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/272187.jpg';
$name = "Stylidocleome brachycarpa";
$family = "Cleomaceae";
$collection = "55";
$collector = "Hooker, J.D.";
$location = "-";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/133322.jpg';
$name = "Acrostemon barkerae ";
$family = "Ericaceae";
$collection = "7523";
$collector = "Barker, W.F";
$location = "South Africa";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/133314.jpg';
$name = "Acrostemon viscidus";
$family = "Ericaceae";
$collection = "2181";
$collector = "Guthrie, F.";
$location = "South Africa";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/141320.jpg';
$name = "Agapetes forrestii";
$family = "Ericaceae";
$collection = "26583";
$collector = "Forrest, G.";
$location = "China";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/316176.jpg';
$name = "Agapetes nutans";
$family = "Ericaceae";
$collection = "36347";
$collector = "Burkill ";
$location = "Nepal";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/200635.jpg';
$name = "Agarista eucalyptoides";
$family = "Ericaceae";
$collection = "4986";
$collector = "Gardner, G.";
$location = "Minas Gerais";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/37569.jpg';
$name = "Gisekia pharnaceoides";
$family = "Gisekiaceae";
$collection = "63";
$collector = "Sieber";
$location = "Senegal";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/1016830.jpg';
$name = "Aosa sigmoidea";
$family = "Loasaceae";
$collection = "9240";
$collector = "Anderson, W.A.";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/37566.jpg';
$name = "Gisekia africana var. africana";
$family = "Loasaceae";
$collection = "2";
$collector = "Drege";
$location = "South Africa";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/225015.jpg';
$name = "Blumenbachia hieronymi";
$family = "Loasaceae";
$collection = "2940";
$collector = "Kurtz";
$location = "Argentina";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/225049.jpg';
$name = "Caiophora cirsiifolia";
$family = "Loasaceae";
$collection = "893";
$collector = "Mathews";
$location = "Peru";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/193578.jpg';
$name = "Loasa grandiflora";
$family = "Loasaceae";
$collection = "68";
$collector = "Jameson";
$location = "Ecuador. Pichincha";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/47755.jpg';
$name = "Grevea eggelingii subsp. echinocarpa";
$family = "Montiniaceae";
$collection = "11.708";
$collector = "Torre, A.R.; J. Paiva ";
$location = "Mozambique";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/47792.jpg';
$name = "Montinia caryophyllacea";
$family = "Montiniaceae";
$collection = "s.n";
$collector = "Pappe";
$location = "South Africa";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/224118.jpg';
$name = "Adenanthe bicarpellata";
$family = "Ochnaceae";
$collection = "377";
$collector = "Steyermark, J.A.; Wurdack, J.J.";
$location = "Venezuela";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/762592.jpg';
$name = "Blastemanthus gemmiflorus";
$family = "Ochnaceae";
$collection = "10831";
$collector = "Rodrigues, W.A.";
$location = "Brazil";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/110414.jpg';
$name = "Campylospermum elongatum";
$family = "Ochnaceae";
$collection = "77";
$collector = "Mann";
$location = "Equatorial Guinea.";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/773138.jpg';
$name = "Meliosma dentata ";
$family = "Sabiaceae";
$collection = "6378";
$collector = "Yuncker, T.G.;";
$location = "Honduras";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/275736.jpg';
$name = "Sabia campanulata";
$family = "Sabiaceae";
$collection = "329";
$collector = "Wilson, E.H.";
$location = "China";

insertPlant($url, $name, $family, $collection, $collector, $location);

$url = 'http://www.kew.org/herbcatimg/275730.jpg';
$name = "Sabia swinhoei";
$family = "Sabiaceae";
$collection = "4806";
$collector = "Wilson, E.H. ";
$location = "China";

insertPlant($url, $name, $family, $collection, $collector, $location);

?>

