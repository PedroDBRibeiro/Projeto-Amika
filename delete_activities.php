<?php

include ("config.php");

if(isset($_POST["id"])) 
{
/*$query = 'DELETE from atividades WHERE ID_ATIVIDADE=:id'; */

 $statement = $mysqli->prepare('DELETE from atividades WHERE id_atividade=:id');
 $statement->execute(
  array(
   ':id' => $_POST['id'] 
  )
 );
}

?>
