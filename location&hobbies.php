<?php
include "config.php";

$search_results = [];

if (isset($_POST['submit1'])) {
  //only get names of checked boxes on the dropdown menus that actually have checked boxes
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



  if (isset($localizacao)) {
    if (isset($hobbies)) {
      $sql = "SELECT u.user_id, u.nome, u.avatar, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id
              AND u.REGIAO = '$localizacao'
              AND ( h.hobbie IN ('$hobbies') )
              GROUP BY u.user_id;";
    } else {

      $sql = "SELECT u.user_id, u.nome, u.avatar, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id
              AND u.REGIAO = '$localizacao'
              GROUP BY u.user_id;";
    }
  } else {
    if (isset($hobbies)) {

      $sql = "SELECT u.user_id, u.nome, u.avatar, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id
              AND ( h.hobbie IN ('$hobbies') )
              GROUP BY u.user_id;";
    } else {

      $sql = "SELECT u.user_id, u.nome, u.avatar, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.user_id = h.user_id
              GROUP BY u.user_id;";
    }
  } 


  //get query results
  $result = mysqli_query($mysqli, $sql);
  $resultCheck = mysqli_num_rows($result);

  //if there is 1 or more results, save them in $posts
  if ($resultCheck > 0) {
    while ($found = mysqli_fetch_assoc($result)) {
      $search_results[] = $found;
  }
    //if not, show a message saying that no results were found
  } else {
    $no_results = "Não há ninguém com esta localização e hobbies :(";
  }
} 

 

