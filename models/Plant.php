<?php
require_once('Connection.php');

class Plant{
    private $id;
    private $name;
    private $family;
    private $collection;
    private $collector;
    private $location;
    private $image;
    
    //Constructorul

    public function __construct($name, $family, $collection, $collector, $location, $image){
        $this->name = $name;
        $this->family = $family;
        $this->collection = $collection;
        $this->collector = $collector;
        $this->location = $location;
        $this->image = $image;
    }

    //name

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
    }
    
    //family

	public function getFamily() {
		return $this->family;
	}

	public function setFamily($family) {
		$this->family = $family;
	}

    //collection

	public function getCollection() {
		return $this->collection;
	}

	public function setCollection($collection) {
		$this->collection = $collection;
	}

    //collecter

	public function getCollector() {
		return $this->collecter;
	}

	public function setCollecter($collector) {
		$this->collector = $collector;
	}

    //location

	public function getLocation() {
		return $this->location;
	}

	public function setLocation($location) {
		$this->location = $location;
	}

    //image

	public function getImage() {
		return $this->image;
	}

	public function setImage($image) {
		$this->image = $image;
	}
}

class Delete extends Plant{
	private $tableName;

    public function __construct($tableName){
        $this->tableName = $tableName;
    }

    public function deletePlant(): bool{

        
        $connection = Connection::Instance();
        
        // Select Database
        mysqli_select_db($connection, 'planty');

        echo mysqli_error($connection);

        if (isset($_POST['pl_submit'])) {
			if(isset($_POST['plant'])){
	
			// Add plant to album
			$plant = $_POST['plant'];
			$id = $_POST['a_album_id'];
	
			$query1 = "SELECT id FROM plant WHERE name='" . $plant  ."';";
			$result = mysqli_query($connection, $query1);
			$idp = mysqli_fetch_row($result)[0];
				
			$query = "DELETE FROM plant_album WHERE id_album=" . $id . " AND id_plant=" . $idp . ";";

			if(!($result = mysqli_query($connection, $query))){
				throw new Exception("Error: not deleted");
			}
			else{

					return true;
				} 
        	}
    	}
	}
}

?>