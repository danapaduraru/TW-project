<?php 
require_once('../models/User.php');

if (isset($_POST['l_submit'])) {
    $email = $_POST['l_email'];
    $password = $_POST['l_password'];

    // Create User object
    $user = new User($fullname, $email, $password);
    
    // Try to register user
    if($user->loginUser()) {
        // If query was successful, redirect to dashboard
        header('Location: ../views/dashboard.html');
    }
    else {
        // "Something went wrong" message should appear
        header('Location: ../views/index.html');
    }
}
?>