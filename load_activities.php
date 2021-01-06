<?php

// CARREGAR ATIVIDADES DO UTILIZADOR E QUE MARCARAM COM O UTILIZADOR NA AGENDA

session_start();

$session_id = $_SESSION['user_id'];

$connect = new PDO('mysql:host=localhost;dbname=amika;charset=utf8', 'root', '');

$data = array();

//query que vai buscar as atividades à bd
$query = "SELECT users_act.* , u.nome as NOME from (
        select ID_ATIVIDADE, TITULO, id_user2 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id
        union
        select ID_ATIVIDADE, TITULO, id_user1 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id) as users_act
        join utilizadores as u 
        on users_act.id=u.user_id
    where users_act.id <> $session_id;";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

//passa os nomes da variáveis para o calendário
foreach ($result as $row) {
        $data[] = array(
                'id'   => $row["ID_ATIVIDADE"],
                'title'   => $row["TITULO"],
                'start'   => $row["DATA_INICIO"],
                'end'   => $row["DATA_FIM"],
                'nome_amigo'   => $row["NOME"],
                'desc'   => $row["DESCRICAO"]
        );
}

echo json_encode($data);
