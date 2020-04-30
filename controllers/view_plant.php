<?php 

// Cum afisam o imagine (dummy code, doar ca sa il avem)

require_once('../models/Connection.php');
$connection = Connection::Instance();

// Select Database
mysqli_select_db($connection, 'planty');  

$query = "SELECT image from plant where id = 5";

$result = mysqli_query($connection, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));

$img=mysqli_fetch_array($result);

echo '<img src="data:image/jpeg;base64,'.base64_encode( $img[0] ).'"/>';

?>

<html>
    <body>
      
    </body>
</html>