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
?>