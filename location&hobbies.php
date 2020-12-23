<?php
include "config.php";

$search_results = [];

if (isset($_POST['submit'])) {
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
      $sql = "SELECT u.id_user, u.nome, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.id_user = h.id_user
              AND u.REGIAO = '$localizacao'
              AND ( h.hobbie IN ('$hobbies') )
              GROUP BY u.id_user;";
    } else {

      $sql = "SELECT u.id_user, u.nome, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.id_user = h.id_user
              AND u.REGIAO = '$localizacao'
              GROUP BY u.id_user;";
    }
  } else {
    if (isset($hobbies)) {

      $sql = "SELECT u.id_user, u.nome, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.id_user = h.id_user
              AND ( h.hobbie IN ('$hobbies') )
              GROUP BY u.id_user;";
    } else {

      $sql = "SELECT u.id_user, u.nome, GROUP_CONCAT(h.hobbie SEPARATOR ' ') as allhobbies, u.REGIAO
              FROM utilizadores as u, hobbies as h
              WHERE u.id_user = h.id_user
              GROUP BY u.id_user;";
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
    echo "Não há ninguém com esta localização e hobbies :(";
  }
} 



/*

if (isset($_POST['localização'])) {
  $localização = $_POST['localização'];
  echo $localização;
} else {
  $localização = null;
}

if (isset($_POST["hobbies"])) {
  $hobbies = $_POST['hobbies'];
  //print_r ($hobbies);

  $sql = "select * from hobbies";

  $result = mysqli_query($mysqli, $sql);

  //$rows = mysqli_num_rows($result);

  while ($row = mysqli_fetch_array($result)) {
    echo $row['id_utilizador'];
    echo " ";

    foreach ($hobbies as $hobbie) {

      if ($hobbie == $row['hobbie']) {
        echo $row['hobbie'];
        echo " ";
      }
      if ($hobbie == $row['hobbie2']) {
        echo $row['hobbie2'];
        echo " ";
      }
      if ($hobbie == $row['hobbie3']) {
        echo $row['hobbie3'];
        echo " ";
      }
      if ($hobbie == $row['hobbie4']) {
        echo $row['hobbie4'];
        echo " ";
      }
      if ($hobbie == $row['hobbie5']) {
        echo $row['hobbie5'];
        echo " ";
      }
      if ($hobbie == $row['hobbie6']) {
        echo $row['hobbie6'];
        echo " ";
      }
      if ($hobbie == $row['hobbie7']) {
        echo $row['hobbie7'];
        echo " ";
      }
      if ($hobbie == $row['hobbie8']) {
        echo $row['hobbie8'];
        echo " ";
      }
      if ($hobbie == $row['hobbie9']) {
        echo $row['hobbie9'];
        echo " ";
      }
      if ($hobbie == $row['hobbie10']) {
        echo $row['hobbie10'];
        echo " ";
      }
      if ($hobbie == $row['hobbie11']) {
        echo $row['hobbie11'];
        echo " ";
      }
    }
    echo "<br>";
  }
} else {
  $hobbies = null;
}
*/
