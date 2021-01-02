<?php

session_start();
include "config.php";

$user_id = $_SESSION['user_id'];

$user_query = "SELECT * FROM utilizadores WHERE user_id = '$user_id';";
$result = mysqli_query($mysqli, $user_query);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck == 1) {
  $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {

  //todos os campos
  $location = $_POST['location'];
  $username = $_POST['username'];
  $age = $_POST['age'];
  $email = $_POST['email'];
  

  if (!empty($_FILES["avatar"]["tmp_name"])) {
    //flag que indica se a imagem pode ser carregada ou não
    $uploadOk = 1;
    //imagem recebida no form
    $image = addslashes(file_get_contents($_FILES["avatar"]["tmp_name"]));

    //ver se o ficheiro é realmente uma imagem
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }

    //ver se o tamanho da imagem é suportado
    if ($_FILES["avatar"]["size"] > 4294967295) {
     $uploadOk = 0;
   }

    //se a imagem estiver ok, atualizar na bd
    if ($uploadOk == 1) {
      $sql = "UPDATE utilizadores
           SET regiao= '$location',
               nome= '$username', 
               idade= '$age', 
               email= '$email',
               avatar= '$image'
           WHERE user_id='$user_id'";


      mysqli_query($mysqli, $sql);

      if (mysqli_affected_rows($mysqli)) {

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Perfil editado com sucesso!
       <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: myprofile.php");
      } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao editar o perfil.
       <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: myprofile.php");
      }
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>A imagem não é suportada.
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: myprofile.php");
    }

  } else {

    $sql = "UPDATE utilizadores
    SET regiao= '$location',
        nome= '$username', 
        idade= '$age', 
        email= '$email'
    WHERE user_id='$user_id'";

    mysqli_query($mysqli, $sql);

    if (mysqli_affected_rows($mysqli)) {

      $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Perfil editado com sucesso!
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: myprofile.php");
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao editar o perfil.
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: myprofile.php");
    }


  }
} else {
  $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Ocorreu um erro ao submeter a edição do perfil.
  <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span></button></div>";
  header("Location: myprofile.php");
}
