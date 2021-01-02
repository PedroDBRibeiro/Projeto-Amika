<?php

session_start();

$session_id = $_SESSION['user_id'];

$connect = new PDO('mysql:host=localhost;dbname=amika;charset=utf8', 'root', '');

$data = array();

$query = "SELECT users_act.* , u.nome as NOME, c.CATEGORIA from (
        select ID_ATIVIDADE, ID_CATEGORIA, id_user2 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id
        union
        select ID_ATIVIDADE, ID_CATEGORIA, id_user1 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id) as users_act
        join utilizadores as u 
        on users_act.id=u.user_id
        join categoria as c
        on users_act.ID_CATEGORIA = c.ID_CATEGORIA
    where users_act.id <> $session_id;";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row) {
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
