<?php

include "config.php";

echo($_POST['nome']);
echo($_POST['psw']);
echo($_POST['email']);
echo($_POST['pswConfirm']);
echo($_POST['tipoUser']);
echo($_POST['regiao']);
echo($_POST['idade']);

$tipoUser;
$value = 0;
$textoDescritivo;

if (is_null($_POST['deficiencia'])){
    $textoDescritivo = '';
} else {
    $textoDescritivo = $_POST['deficiencia'];
}

if ($_POST['tipoUser'] == 'voluntario') {
    $tipoUser = 0;
}
else {
     $tipoUser = 1;
    }


if (!isset($_POST['nome'], $_POST['psw'], $_POST['email'], $_POST['pswConfirm'])) {
	exit('Por Favor Complete o Registo!');
}

if (empty($_POST['nome']) || empty($_POST['psw']) || empty($_POST['email'])) {
    exit('Por Favor Complete o Registo!');
}

if( $_POST['psw'] !== $_POST['pswConfirm']){
    exit('Passwords nao correspondem');
}

if ($stmt = $mysqli->prepare('SELECT ID_USER, PASSWORD FROM utilizadores WHERE EMAIL = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
		echo 'O email que forneceu já está registado!';
    }   else  {
        
if ($stmt = $mysqli->prepare('INSERT INTO utilizadores (NOME, PASSWORD, EMAIL) VALUES (?,?,?)')) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('Email inváido');
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['nome']) == 0) {
        exit('Nome Inválido');
    }
    
    if (strlen($_POST['psw']) > 20 || strlen($_POST['psw']) < 5) {
        exit('Password tem de ter entre 5 e 20 caracteres');

    }

	$password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
	$stmt->bind_param('sss', $_POST['nome'], $password, $_POST['email']);
	$stmt->execute();
    echo 'Registo Bem Sucedido.';
    header('Location: homepage.php');

} else {
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}

$mysqli->close();

?>