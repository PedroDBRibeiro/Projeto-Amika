

<?php

//ESTA PÁGINA TEM LINKS PARA PÁGINAS QUE PODEM TER INFORMAÇÕES ÚTEIS PARA OS UTILIZADORES 

session_start();

include('newHeader.php');

?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');
</style>

<body>

    <div align ="center" style="margin-top:80px;">
        <div class="title-back" >
            <h1 class = "title ">
              Informações
            </h1>
        </div>
    </div>

  <p style=" text-align: center; font-family: 'Chewy';margin-top: 20px;font-size: 20px;">
    Nesta página encontram-se disponíveis links de páginas de associações que podem ser úteis:</p>

  <div class="container">
    <div class="row mt-5 justify-content-center">
    <!--LINK PARA PÁGINA DO INR-->
      <div class="col-sm-6 col-md-4 col-xs-12 py-2">
        <div class="card card-body mx-2 mb-3" style="width: 18rem;">
          <img class="card-img-top" src="imagens/INR.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">INR</h5>
            <p class="card-text">O Instituto Nacional para a Reabilitação tem por missão assegurar o planeamento, execução e coordenação das políticas nacionais destinadas a promover os direitos das pessoas com deficiência.</p>
            <a href="https://www.inr.pt/inr" class="btn btn-primary">Ir para o site</a>
          </div>
        </div>
      </div>
    <!--LINK PARA PÁGINA DO AAPACDM-->
      <div class="col-sm-6 col-md-4 col-xs-12 py-2">
        <div class="card card-body mx-2 mb-3" style="width: 18rem;">
          <img class="card-img-top" src="imagens/AAPACDM.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">AAPACDM</h5>
            <p class="card-text">A Associação Algarvia de Pais e Amigos das Crianças Diminuídas Mentais é uma Instituição Particular de Solidariedade Social, sem fins lucrativos, reconhecida como de Utilidade Pública Administrativa.</p>
            <a href="https://www.aapacdm.com/" class="btn btn-primary">Ir para o site</a>
          </div>
        </div>
      </div>
    <!--LINK PARA PÁGINA DO PNAR-->
      <div class="col-sm-6 col-md-4 col-xs-12 py-2">
        <div class="card card-body mx-2 mb-3" style="width: 18rem;">
          <img class="card-img-top" src="imagens/PNR.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">PNAR</h5>
            <p class="card-text">A Plataforma Nacional de Autorrepresentantes — PNAR – deseja dar voz aos autorrepresentantes de Portugal. <br> <br> <br> <br></p>
            <a href="http://plataforma-autorrepresentantes.pt/" class="btn btn-primary">Ir para o site</a>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>



</body>

</html>