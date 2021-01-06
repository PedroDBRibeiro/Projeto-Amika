<?php

session_start();
include "config.php";

$comment_id = $_GET["commentId"];

if (isset($_POST['submit'])) {

$sql = "DELETE FROM comentarios where ID_COMENTARIO = $comment_id";

mysqli_query($mysqli, $sql);

if (mysqli_affected_rows($mysqli)) {

    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O comentário foi apagado com sucesso.
   <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
   <span aria-hidden='true'>&times;</span></button></div>";
    header("Location: forum.php");
  }

}
