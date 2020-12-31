<?php

$connect = new PDO('mysql:host=localhost;dbname=amika;charset=utf8', 'root', '');

$data = array();

$query = "SELECT a.*, u.nome as NOME, c.CATEGORIA FROM atividades as a, categoria as c, utilizadores as u
        WHERE a.ID_CATEGORIA = c.ID_CATEGORIA
        AND a.id_user2 = u.user_id
        ORDER BY ID_ATIVIDADE";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll(); 

foreach($result as $row) 
{
 $data[] = array(
  'id'   => $row["ID_ATIVIDADE"],
  'title'   => $row["CATEGORIA"],
  'start'   => $row["DATA_INICIO"],
  'end'   => $row["DATA_FIM"],
  'nome_amigo'   => $row["NOME"],
  'desc'   => $row["DESCRICAO"]
 );
}

echo json_encode($data);

?>
