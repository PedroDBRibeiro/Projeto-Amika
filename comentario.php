<?php
session_start();
include "config.php";


$postId = $_GET["postId"];
$id = $_SESSION['user_id'];
$comentario = $_POST['comentario'];
$data = date('Y-m-d H:i:s', strtotime($_POST['data_com']));

echo $_POST['data_com'];
echo $comentario;

if (!isset($comentario)) {
  echo "Por favor, escreve algo!";
} else {
  $insert = "INSERT INTO comentarios (ID_USER, POST_ID, COMENTARIO, DATA) VALUES ($id, $postId, '$comentario', '$data')";
  if ($mysqli->query($insert) === TRUE) {
    echo "O comentário foi adicionado!";
    header("Location: forum.php");
  }
}

$mysqli->close();
