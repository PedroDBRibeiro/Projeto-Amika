<?php
session_start();

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

  <!-- Custom css-->
  <link href="login.css" rel="stylesheet">

  <title>Log In</title>

</head>

<body>

  <div class="hero">
    <a class="logo" href="index.php"><img src="images/logo1.png"></a>

    <div class="form-box">
      <div class="button-box">
        <div id="btn-login"></div>
        <button type="button" class="toggle-btn" onclick="logIn()">Log In</button>
        <button type="button" class="toggle-btn" onclick="signUp()">Sign Up</button>
      </div>

      <form id="login" class="input-group" method="post" action="authenticate_login.php">
        <input type="text" class="input-field" name="usernameLogin" placeholder="Username" required>
        <input type="password" class="input-field" name="passwordLogin" placeholder="Password" required>
        <a style="text-decoration:underline;" href="signup.php"><br>I don't have an account</a>
        <?php
        if (isset($_SESSION["error"])) {
          $error = $_SESSION["error"];
          echo "<span>$error</span>";
        }
        ?>
        <!--<input type="checkbox" class="check-box"><span>Remember password</span>-->
        <button type="submit" class="submit-btn">Log In</button>
      </form>


    </div>


  </div>

  <script>
  
    var btn = document.getElementById("btn-login");

    function signUp() {
      btn.style.left = "100px";
      setTimeout(function() { location.href = "signup.php" }, 500);
    }

  </script>

</body>

</html>

<?php
    unset($_SESSION["error"]);
?>