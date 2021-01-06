<?php

// ATUALIZAR DETALHES DE UMA ATIVIDADE 

session_start();
include "config.php";

if (isset($_POST['submit'])) {

  //info inserida no popup de editar atividade
  $id = $_POST['id'];
  $title = $_POST["title"];
  $start = $_POST["start"];
  $end = $_POST["end"];
  $desc = $_POST["desc"];

  if (!empty($id) && !empty($title) && !empty($start) && !empty($end)) {
    //Converte data e hora de inicio no formato da BD
    $data = explode(' ', $start);
    list($data, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $data));
    $data_sem_barra = implode("-", $data_sem_barra);
    $datainicio = $data_sem_barra . " " . $hora;

    //Converte data e hora de fim no formato da BD
    $data = explode(' ', $end);
    list($data, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $data));
    $data_sem_barra = implode("-", $data_sem_barra);
    $datafim = $data_sem_barra . " " . $hora;



    if (empty($desc)) {
      //se não houver descrição nova, atualiza todos os outros campos preenchidos
      $query = "UPDATE atividades 
            SET TITULO='$title', DATA_INICIO='$datainicio', DATA_FIM='$datafim'
            WHERE ID_ATIVIDADE='$id';";
    } else {
      //se existir descrição nova, atualiza todos os campos
      $query = "UPDATE atividades 
            SET TITULO='$title', DATA_INICIO='$datainicio', DATA_FIM='$datafim', DESCRICAO='$desc'
            WHERE ID_ATIVIDADE='$id';";
    }

    mysqli_query($mysqli, $query);

    if (mysqli_affected_rows($mysqli)) {

      //mensagens de erro 

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
