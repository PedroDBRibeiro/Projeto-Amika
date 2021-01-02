<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/Amik@.css">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="font-family: 'Chewy';">
<ul class="navbar-nav m-auto">
<a class="navbar-brand" href="Homepage.php">
<img src="Imagens\Logo.png" alt="Logo Amik@"  width="170" height="80"></img>
</a>
</ul>     
</nav>

<style>

@import url('https://fonts.googleapis.com/css?family=Numans');
</style>


<body>

    <div class="main" style="margin-top:100px;">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content" style=" background: #03036B;">
                    <form action="register.php" method="POST"  autocomplete="on" id="signup-form" class="signup-form">
                        <h2 class="form-title" style = "color: white;font-family: 'Numans', sans-serif; ">Registo</h2>

                        <div class="form-group" style=" background:white;">
                        <input class="form-input" type="text" placeholder="Introduza o seu Nome" name="nome" id="nome" required>
                        </div>
                        
                        <div class="form-group" style=" background:white;">
                        <input class="form-input" type="text" placeholder="Introduza a sua Idade" name="idade" id="idade" required>
                        </div>

                        <div class="form-group" style=" background:white;">
                        <input class="form-input" type="text" placeholder="Introduza a sua Idade" name="idade" id="idade" required>
                        </div>

                        <div class="form-group" style=" background:white;">
                        <input class="form-input" type="text" placeholder="Introduza a Sua idade" name="idade" id="idade" required>
                        </div>

                        <div class="form-group" style=" background:white;">
                        <input class="form-input" type="text" placeholder="Introduza a seu email" name="email" id="email" required>
                        </div>

                        <div class="form-group" style=" background:white;">
                        <input class="form-input" type="password" placeholder="Introduza a Palavra-passe" name="psw" id="psw" required>
                        </div>
                        
                        <div class="form-group" style=" background:white;">
                        <input class="form-input" type="password" placeholder="Repita a Palavra-passe" name="pswConfirm" id="pswConfirm" required>
                        </div>

                        <select class="selectpicker" name="regiao" id="regiao" required style="font-family: 'Numans', sans-serif;">
                    <option disabled selected value>Escolhe a tua localização</option>
                    <option value="Barlavento">Barlavento</option>
                    <option value="Centro">Centro</option>
                    <option value="Sotavento">Sotavento</option>
                        </select>

                        <select  class="selectpicker" onchange="JadiCheck(this)" name="tipoUser" id="tipoUser" style="font-family: 'Numans', sans-serif;" required>
                        <option disabled selected value>Tipo de utilizador</option>
                        <option value="Voluntario">Voluntário</option>
                    <option value="Jadi">Jovem Adulto com Deficiência Intelectual</option>
                        </select>

                        <div class="form-group" id="TextoJadi" style="display: none;"><br>
                    <label style="color:white;" for="deficiencia">Descreva a deficiência: </label> 
                    <input  style="background:white;" class="form-input" type="text" id="deficiencia" name="deficiencia" />
                </div>

                <br><br>  <select name="hob[]" class="selectpicker" multiple title="Escolhe 1 ou mais hobbies">
                <option value="Praia">Praia</option>
                <option value="Passear">Passear</option>
                <option value="Futebol">Futebol</option>
                <option value="Desporto">Desporto</option>
                <option value="Séries/Filmes">Séries/Filmes</option>
                <option value="Fotografia">Fotografia</option>
                <option value="Andar de bicicleta">Andar de bicicleta</option>
                <option value="Ler">Ler</option>
                <option value="Cozinhar">Cozinhar</option>
                <option value="Compras">Compras</option>
                <option value="Puzzles">Puzzles</option>
                    </select>

            
                        <!--
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>-->
                        <br><br><div class="form-group">
                            <input style="color:black;font-family: 'Numans', sans-serif;background-image: linear-gradient(to right, #fbb034 0%, #ffdd00 74%);" type="submit" name="submit" id="submit" class="form-submit" value="Registar-me"/>
                        </div>
                    </form>
                    <p class="loginhere" style="color:white;font-family: 'Numans', sans-serif;">
                       Já tens conta? <a style="color:yellow;font-family: 'Numans', sans-serif;" href="Pagina_login" class="loginhere-link">Entra aqui</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
    function JadiCheck(that) {
    if (that.value == "Jadi") {
        document.getElementById("TextoJadi").style.display = "block";
    } else {
        document.getElementById("TextoJadi").style.display = "none";
    }
}
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>