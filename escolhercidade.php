<?php

// MOSTRA OS PONTOS DE INTERESSE DA CIDADE ESCOLHIDA

include "config.php";
session_start();
include('newHeader.php');



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
                  
        // query que vai buscar à bd os pontos de interesse onde a cidade é = à selecionada na pagina pontosinteresse.php
        $query = "SELECT * from pontos_interesse where cidade = '".$_POST['myvalue']."'";
        $result = mysqli_query($mysqli, $query);
                    
        //os pontos são guardados no array $id_pontos
        while ($id_ponto = mysqli_fetch_assoc($result)) {
        $id_pontos[] = $id_ponto;
        }                               
        ?>
        
        <div>
            <p style=" text-align: center;font-family: 'Chewy'; margin-top: 70px;font-size: 20px;">
                Estes s&atildeo os s&iacutetios mais giros para visitar!
            </p>
        </div>


        <div class="container">
	    <div class="row mt-5 justify-content-center">
        
        <!-- para cada ponto de interesse, mostra um cartão com foto e o nome do local -->
        <?php foreach ($id_pontos as $id_ponto): ?>
                    
            <div class="col-sm-6 col-md-4 col-xs-12 py-2">
                <div class="card card-body mx-2 mb-3" style="width: 18rem;">
                        
                    <!-- base64 encoding para mostrar a imagem que vem da BD -->
                    <img class="card-img-top" <?php echo 'src="data:image/jpg;base64,'.base64_encode($id_ponto['imagem_path']).'"' ?>>
                        <div class="card-body">
                            <h5 class="card-title" style=" font-family: Arial, Helvetica, sans-serif;"><?php echo $id_ponto['ponto']; ?></h5>
                        </div>
                </div>
            </div>
                          
        <?php endforeach; ?>

    </body>
</html>
        
      