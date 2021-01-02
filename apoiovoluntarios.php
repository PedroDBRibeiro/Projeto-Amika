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

  <style>
    body {
      
      background-image: url("images/bg-login.jpeg");
      background-repeat: no-repeat;
      background-size: cover;
      display: block;
      position: scroll;
      background-attachment: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-position: center center;
    }
  </style>
</head>

<body>


  <iframe name="content" style="display:none;"></iframe>
  <form action="uploading.php" method="post" enctype="multipart/form-data" target="content">
    <div class="container" style="position:relative; top: 80px;margin-bottom:200px;">

      <h1>Formulário de Contacto</h1>
      </br>
      </br>
      <h3 class=title3>Utilize este formulário para contactar a administração e pedir autorização para fazer pagamentos ou enviar recibos.</h3>
      <p></p>
      <label for="fname" class=title2>Nome:</label>
      <input type="text" id="fname" name="title">

      <label for="fname" class=title2>Atividade:</label>
      <input type="text" id="fname" name="title">


      <input type="radio" id="orcamento" name="tipodecontacto" value="orcamento" style="height:20px; width:20px;">
      <label class="radio-inline" style="font-size: 15px; color: white" for="orcamento">Orçamento</label><br>
      <input type="radio" id="recibo" name="tipodecontacto" value="recibo" style="height:20px; width:20px;">
      <label class="radio-inline" for="recibo" style="font-size: 15px; color: white">Envio de recibo</label><br>
      </br>

      <label for="subject" class=title2>Mensagem:</label>
      <textarea id="subject" name="subject" style="height:200px" class=text1></textarea>


      <label for="fname" class=title2 class=picturefile>Carregar recibo:</label><br><br>
      <input type="file" name="picturefile">

      <button style="float:right;" type="submit" class="btn success" name="submit" onclick=success()>Enviar</button>
     <!-- <button type="button" class="btn danger" onclick=cancel()>Cancelar</button> -->
    <br><br><br><br>

    </div>
  
  </form>

  <style>
    /* Style inputs with type="text", select elements and textareas */
    input[type=text],
    select,
    textarea {
      width: 100%;
      /* Full width */
      padding: 12px;
      /* Some padding */
      border: 1px solid rgb(226, 223, 223);
      /* Gray border */
      border-radius: 4px;
      /* Rounded borders */
      box-sizing: border-box;
      /* Make sure that padding and width stays in place */
      margin-top: 6px;
      /* Add a top margin */
      box-shadow: 2px 3px 4px 0 rgba(158, 155, 155, 0.2);
      margin-bottom: 35px;
      /* Bottom margin */
      resize: vertical
        /* Allow the user to vertically resize the textarea (not horizontally) */


    }


    input[type=file] {
      border-color: white;

    }

    .radio {
      font-size: 40px;
    }

    .logo {
      padding: 1px;
      margin-top: 5px;
      margin-left: 5px;
    }



    /* Add a background color and some padding around the form */
    .container {
      border-radius: 30px;
      background-color:#7c7e80;
      
      /* 8b979e;*/
      
      padding: 40px 50px 30px;
      width: 800px;
      margin-right: auto;
      margin-left: auto;
      margin-top: auto;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

      ;
    }

    h1 {
      background: rgb(255, 255, 255);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 5px;
      font-weight: bold;
      text-align: center;
    }

    .title3 {
      text-align: center;
      color: rgb(255, 255, 255);
      letter-spacing: 3px;

      font-weight: normal;
      font-size: 18px;

    }


    .title2 {
      font-size: medium;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      color: #ffffff;
      font-weight: bold;

    }


    .btn {
      border: none;
      /* Remove borders */
      color: white;
      /* Add a text color */
      padding: 14px 28px;
      /* Add some padding */
      cursor: pointer;
      /* Add a pointer cursor on mouse-over */
      background-image: linear-gradient(to right, #fbb034 0%, #ffdd00 74%);


    }

    .success {
      background-color: rgb(34, 172, 39);
      padding: 12px 18px;
      border-radius: 6px;
      margin-inline-start: 12px;

      margin-top: 10px;
      box-shadow: 0 4px 8px 0 rgba(46, 45, 45, 0.2);
    }

    /* Green */
    .success:hover {
      background-color: #1a911e;
    }

    .danger {
      background-color: #fd3e30;
      padding: 12px 18px;
      border-radius: 6px;


      margin-top: 10px;
      margin-inline-start: 820px;
      box-shadow: 0 4px 8px 0 rgba(46, 45, 45, 0.2);

    }

    /* Red */
    .danger:hover {
      background: #da190b;
    }


    .text {
      background-color: white;
      color: black;
      font-size: 10vw;
      /* Responsive font size */
      font-weight: bold;
      margin: 0 auto;
      /* Center the text container */
      padding: 10px;
      width: 50%;
      text-align: center;
      /* Center text */
      position: absolute;
      /* Position text */
      top: 50%;
      /* Position text in the middle */
      left: 50%;
      /* Position text in the middle */
      transform: translate(-50%, -50%);
      /* Position text in the middle */
      mix-blend-mode: screen;
      /* This makes the cutout text possible */
    }
  </style>
</body>

<script>
  function success() {
    alert("Formulário enviado");
    window.location.href = "homepage.php";
  }

  function cancel() {
    alert("Tem a certeza que quer sair?");
    window.location.href = "homepage.php";
  }
</script>

</html>