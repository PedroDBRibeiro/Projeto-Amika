<?php

// APAGAR PUBLICAÇÃO DO FÓRUM

session_start();
include "config.php";

$user_id = $_SESSION['user_id'];
$post_id = $_GET["postId"];

if (isset($_POST['submit'])) {

//query que apaga o post da base de dados
$sql = "DELETE FROM posts where post_id = $post_id";

mysqli_query($mysqli, $sql);

if (mysqli_affected_rows($mysqli)) {

    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>A publicação foi apagada com sucesso.
   <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
   <span aria-hidden='true'>&times;</span></button></div>";
    header("Location: forum.php");
  }

}
