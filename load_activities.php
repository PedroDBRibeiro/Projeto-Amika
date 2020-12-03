<?php

//load_activities.php

$connect = new PDO('mysql:host=localhost;dbname=amik@', 'root', '');

$data = array();

$query = "SELECT * FROM atividades ORDER BY ID_ATIVIDADE";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll(); 

foreach($result as $row) 
{
 $data[] = array(
  'id'   => $row["ID_ATIVIDADE"],
  'title'   => $row["CATEGORIA"],
  'start'   => $row["DATA_INICIO"],
  'end'   => $row["DATA_FIM"]
 );
}

echo json_encode($data);

?>
