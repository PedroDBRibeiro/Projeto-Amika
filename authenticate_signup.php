<?php
session_start();

//errors / success messages to echo on the page
$error_inc = 'Please complete the registration form';
$error_user = "This username already exists. Please choose another.";
$success = "You have successfully registered, you can now login!";

// database connection info
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'Amik@';

// connect to the database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// Make sure the submitted registration values are not empty.
if (empty($_POST['usernameSignup']) || empty($_POST['passwordSignup']) || empty($_POST['email'])) {
    // One or more values are empty.
    $_SESSION["error"] = $error_inc;
    header("location: signup.php");
}

if (isset($_POST['submit'])) {
    // We need to check if the account with that username exists.
    if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
        // Bind parameters
        $stmt->bind_param('s', $_POST['usernameSignup']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result so we can check if the account exists in the database.
        if ($stmt->num_rows > 0) {
            // Username already exists
            $_SESSION["error"] = $error_user;
            header("location: signup.php");
        } else {

            // Username doesnt exists, insert new account
            if ($stmt = $con->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
                
                $password = $_POST['passwordSignup'];
                $stmt->bind_param('sss', $_POST['usernameSignup'], $password, $_POST['email']);
                $stmt->execute();
                $_SESSION["error"] = $success;
                header("location: signup.php");
            } else {
                // Something is wrong with the sql statement
                echo 'Could not prepare statement!';
            }
        }
        $stmt->close();
    }
}

$con->close();
