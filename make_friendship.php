<?php

//PÁGINA PARA FAZER AMIZADE COM OUTRO UTILIZADOR

include "config.php";

$session_id = $_SESSION['user_id'];

//verificar se já são amigos
$verify = "SELECT id_user1, id_user2 from matches where (id_user1 ='$session_id' 
and id_user2 = '$user_id') or (id_user2 ='$session_id' and id_user1 = '$user_id') ";

//obter resultados
$result_verify = mysqli_query($mysqli, $verify);

//se ainda não forem amigos:
if( mysqli_num_rows($result_verify) == 0) {

    $amigos = 0;

//fazer amizade --> inserir na BD
if (isset($_POST['makeFriend'])) {
 
 
    $sql = "INSERT INTO `matches`(`id_user1`, `id_user2`) VALUES ('$session_id','$user_id')";
    
    $result = mysqli_query($mysqli, $sql);
      
    $message = " Fez amizade com ".$nome.'!';
        
        }    
    }

    else $amigos = 1;
?>