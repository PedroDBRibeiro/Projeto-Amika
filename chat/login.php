<!--
//login.php
!-->

<?php

include('database_connection.php');

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
      
        header("location:../homepage.php");
        
      }
      else
      {
        // POR MENSAGEM A DIZER QUE A PASS ESTA ERRADA
        header("location:../Homepage.php?msg=failedPass");
       
      }
    }
 }
 else
 {
  // POR MENSAGEM A DIZER QUE O MAIL ESTA ERRADA
  header("location:../Homepage.php?msg=failedEmail");
  
 }
}

?>

