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
    $email = $row['email'];
}

$message = '';
$amigos = '';

include('make_friendship.php');

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
  <link rel="stylesheet" type="text/css" href="CSS/searchCard.css">
  <link href="CSS/myprofile.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');

  </style>
</head>

<body>

    <div align ="center" style="margin-top:50px;">
        <div class="title-back" >
            <h1 class = "title ">
                Perfil de <?php echo $nome ?>
            </h1>
        </div>
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
                                <div class="panel-body text-center"> <img  <?php echo 'src="data:image/jpeg;base64,' .$avatar. '"' ?> class="img-circle profile-avatar" alt="User-Profile-Image"> </div>
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
                                    <br><div class="row">
                                    <?php if ($jadi == 1) { ?>
                                    <div class="col-sm-6">
                                        <h5 class="m-b-10 f-w-600">Deficiência</h5>
                                        <h5 class="text-muted f-w-400"><?php echo $deficiencia;?></h5>
                                    </div>
                                    <?php } ?>
                                    <?php if ($user_id == $_SESSION['user_id']) { ?>
                                    <br>
                                    <div class="col-sm-6">
                                        <h5 class="m-b-10 f-w-600">Email</h5>
                                        <h5 class="text-muted f-w-400"><?php echo $email?></h5>
                                    </div>
                                    </div>
                                    <br><br><div class="row" style="float:right">
                                    <div class="col-sm-6" >
                                        <a href="myprofile.php" class="btn search-btn btn-rounded btn-sm my-0" style="color:white;">Editar Perfil</a>
                                    </div>
                                    </div>
                                    <?php } else{ ?>
                                        <br><br><div class="row" style="float:right">
                                    <div class="col-sm-6">
                                        <form   id="friendship" method="post">
                                        <button type="submit" name="submit" form="friendship" value="Match" class="btn search-btn btn-rounded btn-sm my-0" style="color:white;">
                                        <?php if($amigos == 0) echo 'Fazer amizade'; else echo 'Amigos';?> <img src="imagens/friendship.png"></button>
                                        
                                        <?php if (isset($_POST['submit'])){ ?>                                                                                                                       
                                        </form>
                                    </div>
                                    </div>
                                    <p style="margin-left:335px;"> <?php echo $message; }?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                                   


</body>


</html>