<?php

//PÁGINA COM O ALGORITMO DE PESQUISA COM BASE NOS HOBBIES E LOCALIZAÇÃO ESCOLHIDA

include "config.php";
$jadi = $_SESSION['jadi'];   

$search_results = [];

if (isset($_POST['submit'])) {
  if (!empty($_POST['local'])) {
    $localizacao = $_POST['local'];
  }


  if (!empty($_POST['hob'])) {
    $hob = $_POST['hob'];
    foreach ($_POST['hob'] as $hob) {
      $hob_arr[] = mysqli_real_escape_string($mysqli, $hob);
    }
    $hobbies = implode("','", $hob_arr);
  } 

  
  //algoritmo
  if (isset($localizacao)) {
    if (isset($hobbies)) {
      $sql = "SELECT u.user_id, u.nome, u.avatar, u.jadi, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id and u.jadi <> '$jadi'
              AND u.REGIAO = '$localizacao'
              AND ( h.hobbie IN ('$hobbies') )
              GROUP BY u.user_id;";
    } else {

      $sql = "SELECT u.user_id, u.nome, u.avatar, u.jadi, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id and u.jadi <> '$jadi'
              AND u.REGIAO = '$localizacao'
              GROUP BY u.user_id;";
    }
  } else {
    if (isset($hobbies)) {

      $sql = "SELECT u.user_id, u.nome, u.avatar, u.jadi, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id and u.jadi <> '$jadi'
              AND ( h.hobbie IN ('$hobbies') )
              GROUP BY u.user_id;";
    } else {

      $sql = "SELECT u.user_id, u.nome, u.avatar, u.jadi, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id and u.jadi <> '$jadi'
              GROUP BY u.user_id;";
    }
  } 


  //obter resultados das queries
  $result = mysqli_query($mysqli, $sql);
  $resultCheck = mysqli_num_rows($result);
  
  //se houver mais que 1 resultado, guardar em $search_results
  if ($resultCheck > 0) {
    while ($found = mysqli_fetch_assoc($result)) {
      $search_results[] = $found;
  }
    //se não houver resultados, mostrar mensagem de erro
  } else {
    $no_results = 'Não há ninguém com esta localização e hobbies :(';
  }
} 

 

