<?php

session_start();
include "config.php";

$tipoUser;
$value = 0;
$textoDescritivo;

if (is_null($_POST['deficiencia'])) {
    $textoDescritivo = '';
} else {
    $textoDescritivo = $_POST['deficiencia'];
}

if ($_POST['tipoUser'] == 'Voluntario') {
    $tipoUser = 0;
} else {
    $tipoUser = 1;
}

if (!empty($_FILES["avatar"]["tmp_name"])) {
    //flag que indica se a imagem pode ser carregada ou não
    $uploadOk = 1;

    //imagem recebida no form
    $image = file_get_contents($_FILES["avatar"]["tmp_name"]);

    //ver se o ficheiro é realmente uma imagem
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    //ver se o tamanho da imagem é suportado
    if ($_FILES["avatar"]["size"] > 4294967295) {
        $uploadOk = 0;
    }
} else {
    $uploadOk = 1;
    $image = file_get_contents("Imagens/default_avatar.jpg");
}





if ($stmt = $mysqli->prepare('SELECT user_id, password FROM utilizadores WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'O email que forneceu já está registado!';
    } else {

        if(
            (!isset($_POST['nome'], $_POST['psw'], $_POST['email'], $_POST['pswConfirm'])) || 
            (empty($_POST['nome']) || empty($_POST['psw']) || empty($_POST['email'])) ||
            ($_POST['psw'] !== $_POST['pswConfirm']) ||
            (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ||
            (preg_match('/[A-Za-z0-9]+/', $_POST['nome']) == 0) ||
            (strlen($_POST['psw']) > 20 || strlen($_POST['psw']) < 5) ||
            ($uploadOk == 0)
            
            ){

                if (!isset($_POST['nome'], $_POST['psw'], $_POST['email'], $_POST['pswConfirm'])) {
                    
                    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Por Favor Complete o Registo!
                    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: Pagina_Registo.php");
                }
                
                if (empty($_POST['nome']) || empty($_POST['psw']) || empty($_POST['email'])) {
                    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Por Favor Complete o Registo!
                    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: Pagina_Registo.php");
                }
                
                
                if ($_POST['psw'] !== $_POST['pswConfirm']) {
                    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Passwords não correspondem!
                    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: Pagina_Registo.php");
                }
            
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Email inválido
                    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: Pagina_Registo.php");
            }
            if (preg_match('/[A-Za-z0-9]+/', $_POST['nome']) == 0) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Nome inválido
                    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: Pagina_Registo.php");
            }

            if (strlen($_POST['psw']) > 20 || strlen($_POST['psw']) < 5) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Password tem de ter entre 5 e 20 caracteres
                    <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: Pagina_Registo.php");
                
            }

            if ($uploadOk == 0) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Foto inválida
                <button type'button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span></button></div>";
                header("Location: Pagina_Registo.php");
            }

           
        } else {
            

        if ($stmt = $mysqli->prepare('INSERT INTO utilizadores (nome, password, email, idade, regiao, deficiencia, jadi, status, avatar) VALUES (?,?,?,?,?,?,?,?,?)')) {
            $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
            $stmt->bind_param('sssssssss', $_POST['nome'], $password, $_POST['email'], $_POST['idade'], $_POST['regiao'], $textoDescritivo, $tipoUser, $value, $image);
            $stmt->execute();  
     
            

            if (!empty($_POST['hob'])) {
                $hobbies = $_POST['hob'];
            }

            $last_user_id = mysqli_insert_id($mysqli);

            foreach ($hobbies as $hob) {

                $query_hob = "INSERT INTO hobbies (user_id, hobbie)
                VALUES ($last_user_id, '$hob');";

                mysqli_query($mysqli, $query_hob) or die(mysqli_error($mysqli));
            }
            
            echo 'Registo Bem Sucedido.';
            header('Location: Pagina_login.php');
      
        }
    }       

    }

    $stmt->close();
} 

$mysqli->close();
