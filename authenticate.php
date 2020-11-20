<?php
session_start();
include "config.php";

// Confirmar Login
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	header('Location: Homepage.php?erro=true');
}
 
// SQL Injection
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Armazena resultados para ver se ja existem na database
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // A conta existe agora ver password
        if (password_verify($_POST['password'], $password)) { 
            // Login bem sucedido
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: Homepage.php');
        } else {
            echo 'Incorrect password!';
        }
    } else {
        echo 'Incorrect username!';
    }

	$stmt->close();
}
?>