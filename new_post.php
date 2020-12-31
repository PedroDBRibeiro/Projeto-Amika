<?php

session_start();
include('header.php');
include "config.php";

$user_id = $_SESSION['user_id'];

/*
$user_query = "SELECT * FROM utilizadores WHERE user_id = '$user_id';";
$result = mysqli_query($mysqli, $user_query);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck == 1) {
  $user = mysqli_fetch_assoc($result);
}
*/

if (isset($_POST['submit'])) {

  //todos os campos
  $titulo = $_POST['titulo'];
  $data = date("Y-m-d", strtotime($_POST['date']));
  $texto = $_POST['texto'];


  if (!empty($_FILES["foto"]["tmp_name"])) {
    //flag que indica se a imagem pode ser carregada ou não
    $uploadOk = 1;
    //imagem recebida no form
    $image = addslashes(file_get_contents($_FILES["foto"]["tmp_name"]));

    //ver se o ficheiro é realmente uma imagem
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }

    //ver se o tamanho da imagem é suportado
    if ($_FILES["foto"]["size"] > 4294967295) {
      $uploadOk = 0;
    }

    //se a imagem estiver ok, atualizar na bd
    if ($uploadOk == 1) {
      $sql = "INSERT INTO posts
           (ID_USER, TITLE, TEXT, IMAGEM, DATA)
           VALUES ('$user_id', '$titulo', '$texto', '$image', '$data');";


      mysqli_query($mysqli, $sql);

      if (mysqli_affected_rows($mysqli)) {

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Publicação inserida com sucesso!
       <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: forum.php");
      } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao inserir publicação.
       <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: forum.php");
      }
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>A imagem não é suportada.
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: forum.php");
    }
  } else {

    $sql = "INSERT INTO posts
    (ID_USER, TITLE, TEXT, DATA)
    VALUES ('$user_id', '$titulo', '$texto', '$data');";

    mysqli_query($mysqli, $sql);

    if (mysqli_affected_rows($mysqli)) {

      $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Publicação inserida com sucesso!
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: forum.php");
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao inserir publicação.
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: forum.php");
    }
  }
} else {
  $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Ocorreu um erro ao submeter a publicação.
  <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span></button></div>";
  header("Location: forum.php");
}
