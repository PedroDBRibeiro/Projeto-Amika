<?php
session_start();
include "config.php";

//id do post que se quer comentar
$postId = $_GET["postId"];

//id do user que está logged in
$id = $_SESSION['user_id'];

//texto do comentario
$comentario = $_POST['comentario'];

//por data com o formato aceitado pela base de dados
$data = date('Y-m-d H:i:s', strtotime($_POST['data_com']));

echo $_POST['data_com'];
echo $comentario;

if (!isset($comentario)) {
  echo "Por favor, escreve algo!";
} else {

  //inserir na base de dados o comentário
  $insert = "INSERT INTO comentarios (ID_USER, POST_ID, COMENTARIO, DATA) VALUES ($id, $postId, '$comentario', '$data')";
  if ($mysqli->query($insert) === TRUE) {
    echo "O comentário foi adicionado!";
    header("Location: forum.php");
  }
}

$mysqli->close();
