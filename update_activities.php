<?php

if(isset($_POST["id"]))
{

$connect = new PDO('mysql:host=localhost;dbname=amik@', 'root', '');

 $query = "
 UPDATE atividades 
 SET CATEGORIA=:title, DATA_INICIO=:start_event, DATA_FIM=:end_event 
 WHERE ID_ATIVIDADE=:id
 ;";

 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id'] 
  )
 );

}

?>
