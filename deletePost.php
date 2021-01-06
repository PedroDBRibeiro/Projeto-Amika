<?php

session_start();
include "config.php";

$user_id = $_SESSION['user_id'];
$post_id = $_GET["postId"];

if (isset($_POST['submit'])) {

$sql = "DELETE FROM posts where id_user = $user_id and post_id = $post_id";

mysqli_query($mysqli, $sql);
//header("Location: forum.php");

if (mysqli_affected_rows($mysqli)) {

    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>A publicação foi apagada com sucesso.
   <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
   <span aria-hidden='true'>&times;</span></button></div>";
    header("Location: forum.php");
  }

}
?>