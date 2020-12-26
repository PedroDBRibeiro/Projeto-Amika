<?php


session_start();

include "config.php";

if (isset($_POST['submit'])) {

  if (isset($_POST["id"])) {

    $id = $_POST['id'];
    $query = "DELETE from atividades WHERE ID_ATIVIDADE='$id';";
    mysqli_query($mysqli, $query);

    if (mysqli_affected_rows($mysqli)) {

      $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Atividade eliminada com sucesso!
      <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: calendar.php");
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao eliminar a atividade.
      <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: calendar.php");
    }

  } else {

    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Não sei qual é o id da atividade
    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button></div>";
    header("Location: calendar.php");
  }
} else {

$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Não submeteu
<button type'button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span></button></div>";
header("Location: calendar.php");
}

?>