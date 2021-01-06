<?php 



include('chat/database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
 header('location:../Homepage.php');
}

if(isset($_POST["login"]))
{
 $query = "
   SELECT * FROM utilizadores
    WHERE email = :email
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
    array(
      ':email' => $_POST["email"]
     )
  );
  $count = $statement->rowCount();
  if($count > 0)
 {
  $result = $statement->fetchAll();
    foreach($result as $row)
    {
      if(password_verify($_POST["password"], $row["password"]))
      {
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['lembretes'] = 0;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['jadi'] = $row['jadi'];
        $sub_query = "
        INSERT INTO login_details 
        (user_id) 
        VALUES ('".$row['user_id']."')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertId();
      
        header("location:homepage.php");
        
      }
      else
      {
        // POR MENSAGEM A DIZER QUE A PASS ESTA ERRADA
        //header("location:../Homepage.php?msg=failedPass");
        $message = "Palavra-passe errada";
      }
    }
 }
 else
 {
  // POR MENSAGEM A DIZER QUE O MAIL ESTA ERRADA
  $message = "Mail errado";
 }
}


?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/Amik@.css">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="font-family: 'Chewy';">
<ul class="navbar-nav m-auto">
<a class="navbar-brand" href="Homepage.php">
<img src="Imagens\Logo.png" alt="Logo Amik@"  width="170" height="80"></img>
</a>
</ul>     
</nav>


<body >
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Entrar</h3>
				
			</div>
			<div class="card-body">
			<form method="post">
				<p style="color:white;"><?php echo $message; ?></p>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="text" name ="email" class="form-control" placeholder="Email" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name ="password" class="form-control" placeholder="Palavra-passe" required>
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Lembrar-me
					</div>
					<div class="form-group">
						<input type="submit" name ="login" value="Entrar" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Não tens conta?<a href="Pagina_Registo.php">Increver-me</a>
				</div>
			
			</div>
		</div>
	</div>
</div>
</body>
</html>