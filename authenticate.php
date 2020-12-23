<?php
// TROQUEI O ESTA PAGINA PELO LOGIN.PHP, DAVA-ME MAIS JEITO, POR ISSO DE MOMENTO N ESTA A SER UTILIZADA

/*
session_start();
include "config.php";

// Confirmar Login
if ( !isset($_POST['emailLogin'], $_POST['pswLogin']) ) {
	// Could not get the data that should have been sent.
	header('Location: Homepage.php?erro=true');
}
 
// SQL Injection
if ($stmt = $mysqli->prepare('SELECT user_id, password FROM utilizadores WHERE email = ?')) {
	$stmt->bind_param('s', $_POST['emailLogin']);
	$stmt->execute();
	// Armazena resultados para ver se ja existem na database
	$stmt->store_result();
 
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $password);
        $stmt->fetch();
        // A conta existe agora ver password
        if (password_verify($_POST['pswLogin'], $password)) { 
            // Login bem sucedido
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $_POST['emailLogin'];
            $_SESSION['id'] = $user_id;
            header('Location: Homepage.php');
        } else {
            echo 'Incorrect password!';
        }
    } else {
        echo 'Incorrect username!';
    }

	$stmt->close();
}*/
?>