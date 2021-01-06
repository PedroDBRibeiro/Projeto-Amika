<?php

// INSERE O FORMULÁRIO DE APOIO A VOLUNTÁRIOS NA BASE DE DADOS

session_start();
include "config.php";

$session_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {

  echo "entrou";

  //todos os campos
  $nome = $_POST['nome'];
  $atividade = $_POST['atividade'];
  $mensagem = $_POST['mensagem'];
  $pedido = $_POST['pedido'];
  

  if (!empty($_FILES["imgrecibo"]["tmp_name"])) {
    //flag que indica se a imagem pode ser carregada ou não
    $uploadOk = 1;
    //imagem recebida no form
    $image = addslashes(file_get_contents($_FILES["imgrecibo"]["tmp_name"]));

    //ver se o ficheiro é realmente uma imagem
    $check = getimagesize($_FILES["imgrecibo"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }

    //ver se o tamanho da imagem é suportado
    if ($_FILES["imgrecibo"]["size"] > 4294967295) {
     $uploadOk = 0;
   }

    //se a imagem estiver ok, atualizar na bd
    if ($uploadOk == 1) {
      $sql = "INSERT INTO formularios
           (id_user, nome, atividade, pedido, mensagem, img_recibo)
           VALUES ('$session_id', '$nome', '$atividade', '$pedido', '$mensagem', '$image');";

      mysqli_query($mysqli, $sql);

      if (mysqli_insert_id($mysqli)) {

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Formulário enviado com sucesso!
       <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: apoiovoluntarios.php");
      } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao enviar formulário.
       <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: apoiovoluntarios.php");
      }
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>A imagem do recibo não é suportada.
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: apoiovoluntarios.php");
    }

  } else {

    $sql = "INSERT INTO formularios
           (id_user, nome, atividade, pedido, mensagem)
           VALUES ('$session_id', '$nome', '$atividade', '$pedido', '$mensagem');";

    mysqli_query($mysqli, $sql);

    if (mysqli_insert_id($mysqli)) {

      $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Formulário enviado com sucesso!
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: apoiovoluntarios.php");
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao enviar o formulário.
     <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: apoiovoluntarios.php");
    }


  }
} else {

  $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Ocorreu um erro ao submeter o formulário.
  <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span></button></div>";
  header("Location: apoiovoluntarios.php");
}