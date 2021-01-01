<?php
session_start();
include('newHeader.php');
include "config.php";

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM utilizadores WHERE user_id = '$user_id';";
$result = mysqli_query($mysqli, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck == 1) {
  $user = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

  <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
  <link href="CSS/myprofile.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');


    body {
      font-size: 12px;
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
      margin-bottom: 50px;


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

  if (isset($_SESSION['msg_pass'])) {
    echo $_SESSION['msg_pass'];
    unset($_SESSION['msg_pass']);
  }
  ?>

  <div align ="center" style="margin-top:80px;">
        <div class="title-back" >
            <h1 class = "title ">
                O meu perfil
            </h1>
        </div>
    </div>

  <br />


  <br>
  <div class=form-box>
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-xs-12 col-sm-9">
          <div class="panel panel-default">
            <br>
            <div class="panel-body text-center">
              <img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($user['avatar']) . '"' ?> class="profile-avatar" alt="User avatar">
            </div>
          </div>
          <br>

          <form id="editprofile" method="post" action="myprofileaction.php" enctype="multipart/form-data">
            <div class="panel panel-default">
              <div class="panel-body">

                <div class="form-group">
                  <label class="col-sm-6 control-label">Nova foto de perfil:</label>
                  <div class="col-sm-12">
                    <input type="file" name="avatar">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-6 control-label">Região:</label>

                  <?php
                  $regiao = $user['regiao'];

                  $regioes = array('Barlavento', 'Centro', 'Sotavento');
                  $outras_regioes = array_diff($regioes, array($regiao));
                  ?>

                  <div class="col-sm-12">
                    <select class="form-control" name="location">
                      <option selected=""><?php echo $regiao; ?></option>
                      <?php foreach ($outras_regioes as $or) : ?>
                        <option value="<?php echo $or ?>">
                          <?php echo $or ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-6 control-label">Nome:</label>
                  <div class="col-sm-12">
                    <input type="text" name="username" value=<?php echo $user['nome'] ?> class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-6 control-label">Idade:</label>
                  <div class="col-sm-12">
                    <input type="number" name="age" value=<?php echo $user['idade'] ?> class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-6 control-label">E-mail:</label>
                  <div class="col-sm-12">
                    <input type="email" name="email" value=<?php echo $user['email'] ?> class="form-control">
                  </div>
                </div>



                <div class="form-group">
                  <div class="col-sm-12 text-center">
                  <button type="submit" class="btn btn-success" id="submit" name="submit" form="editprofile">Guardar alterações</button>
                <button type="button" class="btn btn-danger" onclick=cancel()>Cancelar</button>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-sm-offset-2 text-center">
               <br>
                <button type="button" class="btn btn-alt-pass btn-warning">Alterar password</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- POPUP MUDAR PASSWORD -->
  <div class="modal fade" id="mudarPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title w-100" style="font-size:27px; font-family: 'Chewy'; color: #03036B;">Muda a tua password aqui!</h4>
        </div>
        <div class="modal-body">
          <form id="novaPass" method="POST" action="change_password.php">
            <div class="form-row">

              <div class="form-group col-sm-10">
                <label class="col-sm-6">Password antiga:</label>
                <input type="password" name="pass_antiga" id="pass_antiga" class="form-control">
              </div>

              <div class="form-group col-sm-10">
                <label class="col-sm-6">Password nova:</label>
                <input type="password" name="pass_nova" id="pass_nova" class="form-control">
              </div>

            </div>
            <button id="submit" name="submit" type="submit" form="novaPass" class="btn btn-success">Guardar alterações</button>
            <button type="button" class="btn btn-danger" onclick=cancel2()>Cancelar</button>
          </form>

        </div>

      </div>
    </div>
  </div>

  <script>
    function cancel() {
      alert("Tens a certeza que queres sair?");
      window.location.href = "Homepage.php";
    }

    function cancel2() {
      window.location.href = "myprofile.php";
    }

    $('.btn-alt-pass').on("click", function() {
      $('#mudarPass').modal('show');
    });
  </script>

</body>

</html>