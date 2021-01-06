<?php

session_start();
include('header.php');
include "config.php";

$user_id = $_SESSION['user_id'];

//vai buscar o registo do utilizador que está logged in
$user_query = "SELECT password FROM utilizadores WHERE user_id = '$user_id';";
$result = mysqli_query($mysqli, $user_query);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck == 1) {
  $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {

  $pass_antiga = $_POST['pass_antiga'];
  $pass_nova = $_POST['pass_nova'];

  //confirma se a pass antiga é a que está na base de dados
  if (password_verify($pass_antiga, $user['password'])) {

    //confirma se a pass nova tem um número de caracteres válido
    if (strlen($pass_nova) < 20 && strlen($pass_nova) > 5) {

      //confirma se a pass nova é diferente da antiga
      if ($pass_nova !== $pass_antiga) {

        //success!!!
        
        //encripta a pass nova
        $pass_hashed = password_hash($pass_nova, PASSWORD_DEFAULT);

        //query para atualizar a password na base de dados
        $sql = "UPDATE utilizadores
                SET `password` = '$pass_hashed'
                WHERE `user_id` = '$user_id';";

        mysqli_query($mysqli, $sql);

        if (mysqli_affected_rows($mysqli)) {

          $_SESSION['msg_pass'] = "<div class='alert alert-success' role='alert'>Password alterada com sucesso!
          <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></button></div>";
          header("Location: myprofile.php");
        } else {
          $_SESSION['msg_pass'] = "<div class='alert alert-danger' role='alert'>Erro ao alterar a password.
          <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></button></div>";
          header("Location: myprofile.php");
        }
      } else {
        $_SESSION['msg_pass'] = "<div class='alert alert-danger' role='alert'>A password nova não pode ser igual à antiga!
        <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: myprofile.php");
      }
    } else {
      $_SESSION['msg_pass'] = "<div class='alert alert-danger' role='alert'>A password nova tem de ter entre 6 e 19 caracteres!
      <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: myprofile.php");
    }
  } else {
    $_SESSION['msg_pass'] = "<div class='alert alert-danger' role='alert'>A password antiga não está correta!
    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button></div>";
    header("Location: myprofile.php");
  }
}
