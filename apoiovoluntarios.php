<!DOCTYPE html>

<?php

session_start();
include('newHeader.php');

?>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Apoio a Voluntários</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
  <link rel="stylesheet" type="text/css" href="CSS/apoiovoluntarios.css">

  <style>
    body {
      
      background-image: url("images/bg-login.jpeg");
      background-repeat: no-repeat;
      background-size: cover;
      display: block;
      position: scroll;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  </style>
</head>

<body>
  <br>
  <?php
  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  ?>

  <form id="enviarFormulario" action="insert_form.php" enctype="multipart/form-data" method="post" autocomplete="off">
    <div class="container" style="position:relative; top: 80px;">

      <h1>Formulário de Contacto</h1>
      </br>
      </br>
      <h3 class=title3>Utilize este formulário para contactar a administração e pedir autorização para fazer pagamentos ou enviar recibos.</h3>
      <p></p>
      <label class=title2>Nome:</label>
      <input type="text" id="nome" name="nome">

      <label class=title2>Atividade:</label>
      <input type="text" id="atividade" name="atividade">


      <input type="radio" id="orcamento" name="pedido" value="0" style="height:20px; width:20px;">
      <label for="orcamento" class="radio-inline" style="font-size: 15px; color: white" for="orcamento">Orçamento</label><br>
      <input type="radio" id="recibo" name="pedido" value="1" style="height:20px; width:20px;">
      <label for="recibo" class="radio-inline" for="recibo" style="font-size: 15px; color: white">Envio de recibo</label><br>
      </br>

      <label class=title2>Mensagem:</label>
      <textarea id="mensagem" name="mensagem" style="height:200px" class=text1></textarea>


      <label class=title2>Carregar recibo:</label><br><br>
      <input type="file" name="imgrecibo">

    </div>
    <div class="buttons" style="position:relative; margin: 80px;">
      <button type="submit" class="btn success" id="submit" name="submit" form="enviarFormulario">Enviar</button>
      <button type="button" class="btn danger" onclick=cancel()>Cancelar</a>
    </div>
  </form>

</body>

<script>
  function cancel() {
    alert("Tens a certeza que queres sair?");
    window.location.href = "Homepage.php";
  }
</script>

</html>