<?php 

require_once('../models/User.php');

$connection = Connection::Instance();

if (isset($_POST['r_submit'])) {
    $fullname = mysqli_real_escape_string($connection, $_POST['r_fullname']);
    $email = mysqli_real_escape_string($connection, $_POST['r_email']);
    $password = mysqli_real_escape_string($connection, $_POST['r_password']);
    
    // Create User object
    $user = new User($fullname, $email, $password);
    
    // Try to register user
    if($user->registerUser()) {
        
        // If query was successful, redirect to dashboard
        header('Location: ../views/index.php');
    }
    else {
        // "Something went wrong" message should appear
        header('Location: ../views/error.html');
    }
}
?>