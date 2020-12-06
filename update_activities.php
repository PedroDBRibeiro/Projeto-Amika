<?php
include("config.php");

if(isset($_POST["id"])) 
{

 /*$query = "
 UPDATE atividades 
 SET CATEGORIA=:title, DATA_INICIO=:start_event, DATA_FIM=:end_event 
 WHERE ID_ATIVIDADE=:id
 ;";
*/

 $statement = $mysqli->prepare("UPDATE atividades SET CATEGORIA=:title, DATA_INICIO=:start_event, DATA_FIM=:end_event 
                                WHERE ID_ATIVIDADE=:id;");
                                
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
