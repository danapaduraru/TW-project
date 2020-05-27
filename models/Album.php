<?php
require_once('Connection.php');
require_once('../controllers/login.php');

class Album{
    private $id;
    private $name;
    private $short_description;

    //Constructorul

    public function __construct($name, $short_description){
        $this->name = $name;
        $this->short_description = $short_description;
    }

    public function addAlbum(): bool{
        $connection = Connection::Instance();
        
        // Select Database
        mysqli_select_db($connection, 'planty');

        //select id from user
        $query1 = "SELECT id FROM USER WHERE email='" .$_SESSION['login_user']. "';";
        $result1 = mysqli_query($connection, $query1);
        $idFound = mysqli_fetch_row($result1)[0];


        //ad album to database
        $tableName = 'album';
        $query = "INSERT INTO " . $tableName . " (name, short_description, user_id) values ('"
            . $this->getName(). "', '"
            . $this->getShort_description(). "', '"
            . strval($idFound) . "');";


            // Execute query
        if (!($connection->query($query))){
            return false;
        }
        return true;
    }

    
    //name
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    //short_description
    
    public function getShort_description() {
        return $this->short_description;
    }
    
    public function setShort_description($short_description) {
        $this->short_description = $short_description;
    }
}

class Delete extends Album{
    private $tableName;

    public function __construct($tableName){
        $this->tableName = $tableName;
    }

    public function deleteAlbum(): bool{

        
        $connection = Connection::Instance();
        
        // Select Database
        mysqli_select_db($connection, 'planty');

        echo mysqli_error($connection);

        if (isset($_POST['a_submit'])) {
            if(isset($_POST['album_id'])){

                $ida = $_POST['album_id'];

                //delete album from database
                $query = "DELETE FROM plant_album WHERE id_album='". $ida ."';";
                $query1 = "DELETE FROM album WHERE id='". $ida ."';";
                if(!($result = mysqli_query($connection, $query))){
                    throw new Exception("Error: not deleted");
                }
                else{
                    if(!($result = mysqli_query($connection, $query1)))
                    {
                        throw new Exception("Error: not deleted");
                    }
                    else {
                        return true;
                    }
                }
            }
        }
    }
}

?>