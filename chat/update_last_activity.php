<?php

//PÁGINA PARA OBTER O STATUS DOS UTILIZADORES (ONLINE/OFFLINE)

include('database_connection.php');

session_start();

$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>