<?php

session_start();

include "config.php";

if (isset($_POST['submit'])) {

        $session_id = $_SESSION['user_id'];
        $categoria_id = $_POST["categoria"];
        $start = $_POST["start"];
        $end = $_POST["end"];
        $amigo_id = $_POST["amigo"];
        $descricao = $_POST["desc"];


        if (!empty($categoria_id) && !empty($start) && !empty($end)) {

                //Converte data e hora no formato da BD
                $data = explode(' ', $start);
                list($data, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $data));
                $data_sem_barra = implode("-", $data_sem_barra);
                $datainicio = $data_sem_barra . " " . $hora;

                $data = explode(' ', $end);
                list($data, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $data));
                $data_sem_barra = implode("-", $data_sem_barra);
                $datafim = $data_sem_barra . " " . $hora;


                $query = "INSERT INTO atividades
                        (ID_CATEGORIA, DATA_INICIO, DATA_FIM, ID_USER1, ID_USER2, DESCRICAO)
                        VALUES ('$categoria_id', '$datainicio', '$datafim', '$session_id', '$amigo_id', '$descricao');";

                mysqli_query($mysqli, $query);

                if (mysqli_insert_id($mysqli)) {

                        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Atividade inserida com sucesso!
                <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span></button></div>";
                        header("Location: calendar.php");
                } else {
                        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao inserir atividade.
                <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span></button></div>";
                        header("Location: calendar.php");
                }
        } else {

                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Preenche todos os espaços!
        <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button></div>";
                header("Location: calendar.php");
        }
} else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Ocorreu um erro ao submeter a atividade.
        <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button></div>";
        header("Location: calendar.php");
}
