<?php

session_start();

include "config.php";

if (isset($_POST['submit'])) {

  $id = $_POST['id'];
  $categoria = $_POST["categoria"];
  $start = $_POST["start"];
  $end = $_POST["end"];

  if (!empty($id) && !empty($categoria) && !empty($start) && !empty($end)) {
    //Converte data e hora no formato da BD
    $data = explode(' ', $start);
    list($data, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $data));
    $data_sem_barra = implode("-", $data_sem_barra);
    $datainicio = $data_sem_barra . " " . $hora;

    $data = explode(' ', $end);
    list($data, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $data));
    $data_sem_barra = implode("-", $data_sem_barra);
    $datafim = $data_sem_barra . " " . $hora;

    $get_id_categoria = "SELECT ID_CATEGORIA FROM CATEGORIA WHERE CATEGORIA = '$categoria'";

    $idcat1 = mysqli_query($mysqli, $get_id_categoria);
    $idcat2 = mysqli_fetch_assoc($idcat1);
    $idcat = $idcat2['ID_CATEGORIA'];

    $query = "UPDATE atividades 
            SET ID_CATEGORIA='$idcat', DATA_INICIO='$datainicio', DATA_FIM='$datafim'
            WHERE ID_ATIVIDADE='$id';";

    mysqli_query($mysqli, $query);

    if (mysqli_affected_rows($mysqli)) {

      $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Atividade editada com sucesso!
      <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: calendar.php");
    } else {
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao editar a atividade.
      <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span></button></div>";
      header("Location: calendar.php");
    }
  } else {

    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Preenche todos os espaços!
<button type'button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span></button></div>";
    header("Location: calendar.php");
  }
} else {
  $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Ocorreu um erro ao submeter a edição da atividade.
  <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span></button></div>";
  header("Location: calendar.php");
}
