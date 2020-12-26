<?php

include "config.php";

session_start();
include('header.php');
header('Content-Type: text/html; charset=ISO-8859-1');

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pontos de Interesse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
        
    </head>

    <body>

       
        <?php


        $myvalue=$_POST['myvalue'];
                  

        $query = "SELECT * from pontos_interesse where cidade = '".$_POST['myvalue']."'";
        $result = mysqli_query($mysqli, $query);
                    
                    
        while ($id_ponto = mysqli_fetch_assoc($result)) {
        $id_pontos[] = $id_ponto;
        }                               
        ?>

        <div class="container">
	    <div class="row mt-5 justify-content-center">
        
        <?php foreach ($id_pontos as $id_ponto): ?>
                    
            <div class="col-sm-6 col-md-4 col-xs-12 py-2">
                <div class="card card-body mx-2 mb-3" style="width: 18rem;">
                        
                    <img class="card-img-top" <?php echo 'src="data:image/jpg;base64,'.base64_encode($id_ponto['imagem_path']).'"' ?>>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $id_ponto['ponto']; ?></h5>
                        </div>
                </div>
            </div>
                          
        <?php endforeach; ?>

    </body>
</html>
        
      