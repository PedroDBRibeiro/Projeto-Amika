<?php
session_start();
include('header.php');
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
  <div style="background: linear-gradient(#ffff00,#ffd769); width: 25%; margin-top:50px; border-radius: 25px; padding: 5px;" class="center">
    <h1 style="font-family: 'Chewy'; text-align: center; color: #03036B; font-size: 48px; ">
      O meu perfil
    </h1>
  </div>
  <br />

  <br>
  <br>
  <div class=form-box>
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-xs-12 col-sm-9">
          <div class="panel panel-default">
            <br>
            <div class="panel-body text-center">
              <img <?php echo 'src="data:image/jpeg;base64,' . base64_encode($user['avatar']) . '"' ?> class="img-circle profile-avatar" alt="User avatar">
            </div>
          </div>
          <br>
          <iframe name="content" style="display:none;"></iframe>
          <form id="editprofile" method="post" action="myprofileaction.php" target="content">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Região</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="location">
                      <option selected="">Select country</option>
                      <option value="Barlavento">Barlavento</option>
                      <option value="Centro">Centro</option>
                      <option value="Sotavento">Sotavento</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" value=<?php echo $user['nome'] ?> class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Age</label>
                  <div class="col-sm-10">
                    <input type="number" name="age" value=<?php echo $user['idade'] ?> class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-6 control-label">E-mail address</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" value=<?php echo $user['email'] ?> class="form-control">
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-6 control-label">New password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control">
                  </div>
                </div>

                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-success" name="submit" onclick=success()>Submit</button>
                  <button type="button" class="btn btn-danger" onclick=cancel()>Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  function success() {
    alert("You have successfully editted your profile! :)");
    window.location.href = "Homepage.php";
  }

  function cancel() {
    alert("Are you sure you want to leave?");
    window.location.href = "Homepage.php";
  }
</script>

</html>