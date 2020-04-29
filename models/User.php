<?php
require_once('Connection.php');

class User {
    private $id;
    private $fullname;
    private $email;
    private $password;
    
    // Constructor
    // nu punem si id-ul in constructor pentru ca e generat de BD
    public function __construct ($fullname, $email, $password) {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
    }

    public function registerUser(): bool {
        $connection = Connection::Instance();
        
        // Select Database
        mysqli_select_db($connection, 'planty');

        // Check if an account with this email already exists
        $query = "SELECT COUNT(*) FROM USER WHERE email='" . $this->email . "';";
        $result = mysqli_query($connection, $query);
        $count = mysqli_fetch_row($result)[0];
        if ($count != 0) {
            // Email already in database
            return false;
        }
    
        // Add user to the database
        $tableName = 'user';
        $query = "INSERT INTO " . $tableName . " (fullname, email, password) values ('"
            . $this->getFullname() . "', '"
            . $this->getEmail() . "', '"
            . $this->getPassword() . "');";

        // Execute query
        if (!($connection->query($query)))
            return false;
        
        // Verify if query succeeded and user now exists in the database
        $query = "SELECT email FROM " . $tableName . " ORDER BY id DESC LIMIT 1;";
        $result = mysqli_query($connection, $query);
        $emailFound = mysqli_fetch_row($result)[0];
        if ($this->email != $emailFound) {
            return false;
        }
        
        return true;
    }

    public function loginUser(): bool {
        $connection = Connection::Instance();
        
        // Select Database
        mysqli_select_db($connection, 'planty');

        // Check if an account with this email and password exists in database
        $query = "SELECT COUNT(*) FROM USER WHERE email='" . $this->email . "' AND password = '" . $this->password . "';";
        $result = mysqli_query($connection, $query);
        $count = mysqli_fetch_row($result)[0];
        if ($count != 0) {
            // Email and password exists in database
            return true;
        }
        return false;     
    }
    
    // FULLNAME
    public function getFullname() {
        return $this->fullname;
    }
    
    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }
    
    // EMAIL
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    // PASSWORD
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
}

?>  