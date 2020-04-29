<?php
require_once('Connection.php');

class Album{
    private $id;
    private $name;
    private $short_description;

    //Constructorul

    public function __construct($name, $short_description){
        $this->name = $name;
        $this->short_description = $short_description;
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

?>