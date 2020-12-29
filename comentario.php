<?php
session_start();
include "config.php";


$postId = $_GET["postId"];
$id = $_SESSION['user_id'];
$comentario = $_POST['comentario'];


if (!isset($comentario)) {
  echo "Por favor, escreve algo!";
} else {
  $insert = "INSERT INTO comentarios (ID_USER, POST_ID, COMENTARIO) VALUES ($id, $postId, '$comentario')";
  if ($mysqli->query($insert) === TRUE) {
    echo "O comentário foi adicionado!";
    header("Location: forum.php");
  }
}

$mysqli->close();
