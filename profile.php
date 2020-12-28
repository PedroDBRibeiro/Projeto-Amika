<?php

session_start();
include('header.php');
include('config.php');

if (isset($_GET['search_result'])) {
    $user_id = $_GET['search_result'];

    $result = mysqli_query($mysqli, "SELECT * FROM utilizadores WHERE user_id=$user_id") or die(mysqli_error($mysqli));
} else {
    header("location:search.php");
}


while ($row = mysqli_fetch_assoc($result)) {

    $nome = $row["nome"];
    $idade = $row["idade"];
    $regiao = $row["regiao"];
    $jadi= $row["jadi"];
    $deficiencia= $row["deficiencia"];
    $avatar = base64_encode($row['avatar']);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
 
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
  <link href='https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css'>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

  <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
  <link rel="stylesheet" type="text/css" href="CSS/profile.css">
  <link href="CSS/myprofile.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');

  </style>
</head>

<body>
  <div style="background: linear-gradient(#ffff00,#ffd769); width: 25%; margin-top:50px; border-radius: 25px; padding: 5px;" class="center">
    <h1 style="font-family: 'Chewy'; text-align: center; color: #03036B; font-size: 48px; ">
      Perfil de <?php echo $nome ?>
    </h1>
  </div>

  <br>
  <br>
  
        <div class="row container d-flex justify-content-center" style="margin:auto;height:400px;">
            <div style="margin:auto;" >
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full" style="height:400px;width:1000px;margin:auto;">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile" style="margin:auto;">
                            <div class="card-block text-center text-white" style="height:400px;">
                                <div class="panel-body text-center"> <img <?php echo 'src="data:image/jpeg;base64,' .$avatar. '"' ?> class="img-circle profile-avatar" alt="User-Profile-Image"> </div>
                                <br><h4 class="f-w-600" ><?php echo $nome?></h4>
                                <h5><?php if ($jadi == 0) echo "Voluntário"; else echo "Jadi";?></h5> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h4 class="m-b-20 p-b-5 b-b-default f-w-600">Informação</h4>
                                <br><div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="m-b-10 f-w-600">Idade</h5>
                                        <h5 class="text-muted f-w-400"><?php echo $idade?></h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5 class="m-b-10 f-w-600">Região</h5>
                                        <h5 class="text-muted f-w-400"><?php echo $regiao?></h5>
                                    </div>
                                    </div>
                                    <?php if ($jadi == 1) { ?>
                                        <br><div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="m-b-10 f-w-600">Deficiência</h5>
                                        <h5 class="text-muted f-w-400"><?php echo $deficiencia;?></h5>
                                    </div>
                                    <?php } ?>
                                </div>
                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                                   


</body>


</html>