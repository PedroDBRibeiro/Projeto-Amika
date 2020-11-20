<?php
session_start();
//If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="ProjetoCSS.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <script src ="jquery-3.5.1.min.js"> </script>
    <script src="ProjetoScript.js"></script>
    
    <title>Project Taw Pedro Ribeiro R20181114</title>
</head>


<body onload="getMovies('day')">
<nav class="navtop">
<div>
        <h1>Top Movies</h1>
        <a class="this">Today</a>
        <a href="projeto.php">This Week</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        
	</div>
		</nav>
		<div class="content">
			<h2>Welcome back, <?=$_SESSION['name']?></h2>
		</div>

<table id="tabela" border="0">

  <tr class="zero"> 
     <th class=imagem> </th> 
     <th class="posicao"> Position </th>
     <th class= overview> </th>
     <th class="rating"> Rating </th>
     <th class="like"></th>
     <th class="totallikes"> Likes </th>
  </tr>
        

  </body>
</html>
