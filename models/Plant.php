<?php
require_once('Connection.php');

class Plant{
    private $id;
    private $name;
    private $family;
    private $collection;
    private $collecter;
    private $location;
    private $image;
    
    //Constructorul

    public function __construct($name, $family, $collection, $collecter, $location, $image){
        $this->name = $name;
        $this->family = $family;
        $this->collection = $collection;
        $this->collecter = $collecter;
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

	public function getCollecter() {
		return $this->collecter;
	}

	public function setCollecter($collecter) {
		$this->collecter = $collecter;
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