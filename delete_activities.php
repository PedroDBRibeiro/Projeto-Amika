<?php


if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=amik@', 'root', '');
 $query = "
 DELETE from atividades WHERE ID_ATIVIDADE=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id'] 
  )
 );
}

?>
