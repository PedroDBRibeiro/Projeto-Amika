<?php
session_start();
include('header.php');

$user_id = $_SESSION['id'];


if (isset($_POST['submit'])) {

  $location = $_POST['location'];
  $username = $_POST['username'];
  $age = $_POST['age'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  //update database
  $sql = "UPDATE utilizadores
          SET regiao= '$location',
              nome= '$username', 
              idade= '$age', 
              email= '$email',
              password= '$password'
          WHERE user_id=$user_id";
  
mysqli_query($mysqli, $sql);

}

?>