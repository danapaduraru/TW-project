<?php 
require_once('../models/User.php');

if (isset($_POST['r_submit'])) {
    $fullname = $_POST['r_fullname'];
    $email = $_POST['r_email'];
    $password = $_POST['r_password'];
    
    // Create User object
    $user = new User($fullname, $email, $password);
    
    // Try to register user
    if($user->registerUser()) {
        // If query was successful, redirect to dashboard
        header('Location: ../views/dashboard.html');
    }
    else {
        // "Something went wrong" message should appear
        header('Location: ../views/index.html');
    }
}
?>