<?php

//PÁGINA PARA BUSCAR OS AMIGOS DO UTILIZADOR 

include('database_connection.php');

session_start();



$_SESSION['available'] = 0;

//Query para obter os amigos do utilizador
$query = "
SELECT u.user_id, u.nome FROM utilizadores u, matches m
WHERE (m.id_user1 = '".$_SESSION['user_id']."' and m.id_user2 = u.user_id ) or 
(m.id_user2 = '".$_SESSION['user_id']."' and m.id_user1 = u.user_id )  
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

//Tabela para fazer display dos dados (Nome, Estado- online/offline, Ação- enviar mensagem)
$output = '
<table class="table table-bordered table-striped" style="background:white;">
 <tr align="center">
  <th>Nome</th>
  <th>Estado</th>
  <th>Ação</th>
 </tr>
';

foreach($result as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="badge badge-success">Online</span>';
 }
 else
 {
  $status = '<span class="badge badge-danger">Offline</span>';
 }

 $output .= '
 <tr style="background:white;">
  <td align="center">'.$row['nome'].' <span class = "badge badge-success">'.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).'</span></td>
  <td align="center">'.$status.'</td>
  <td align="center"><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tonome="'.$row['nome'].'">Enviar mensagem</button>
 </tr>
 ';
}

$output .= '</table>';

if (sizeof($result) > 0){

echo $output;

$_SESSION['available'] = 1;

}
else {
    //mensagem se o utilizador não tiver amigos
    echo '<h5 align="center">Oops..Ainda não tens amigos :(</h5>';

}

?>