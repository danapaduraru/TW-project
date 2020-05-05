<?php 

session_start();

require_once('../models/User.php');
$connection = Connection::Instance();

if (isset($_POST['l_submit'])) {

    $email = mysqli_real_escape_string($connection, $_POST['l_email']);
    $password = mysqli_real_escape_string($connection, $_POST['l_password']);

    // Create User object
    $user = new User($fullname, $email, $password);
    
    // Try to login user
    if($user->loginUser()) {
        // If query was successful, redirect to dashboard
        $_SESSION['login_user']= $email;
        header('Location: ../views/dashboard.html');
    }
    else {
        // "Something went wrong" message should appear
        header('Location: ../views/index.html');
    }
}
?>