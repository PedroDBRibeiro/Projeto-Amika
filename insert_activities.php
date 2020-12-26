<?php
include("config.php");

if(isset($_POST["title"]))
{ 

// esta a inserir o user_id, vol_user_id e id_categoria à bruta
// ainda ha muita coisa a alterar. mas o calendario funciona

/*$query = "INSERT INTO atividades
        (user_id, VOL_user_id, ID_CATEGORIA, CATEGORIA, DATA_INICIO, DATA_FIM)
        VALUES (1,1,1,:title, :start_event, :end_event);" ;
*/
        
$statement = $mysqli->prepare("INSERT INTO atividades (user_id, vol_user_id, id_categoria, categoria, data_inicio, data_fim)
                               VALUES (1,1,1,:title, :start_event, :end_event);"); 
                               
$statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );

}


?>