<?php

//load_activities.php
include ("config.php");

$data = array();

/*$query = "SELECT * FROM atividades ORDER BY id_atividade";*/

$statement = $mysqli->prepare("SELECT * FROM atividades ORDER BY id_atividade");

$statement->execute();

$result = $statement->fetchAll(); 

foreach($result as $row) 
{
 $data[] = array(
  'id'   => $row["id_atividade"],
  'title'   => $row["categoria"],
  'start'   => $row["data_inicio"],
  'end'   => $row["data_fim"]
 );
}

echo json_encode($data);

?>
