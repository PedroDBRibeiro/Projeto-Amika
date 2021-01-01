

<!DOCTYPE html>

<html>
    <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Projeto Amik@</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="">

            <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
            <link rel="stylesheet" type="text/css" href="CSS/Login.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head> 


    <body>
    <header>

        <table class="tabelaHeader" >

            <tr>
                <th >
                    
                <?php 
                   if(isset($_SESSION['loggedin'])){
         ?>
                    <a  href="Profile.php" style="text-decoration:none;"> 
                        <img src="imagens\profile.png" alt="Profile Icon" class="IconHeader"></img>
                        <p class="hyperlink">PERFIL</p> 
                    </a>
                    
                    <?php }
               else{ ?>
                   
                   
         <?php 
           } 
         ?>


                </th>

                <th>
                    <img src="Imagens\LogoAmika.png" alt="Logo Amik@" class="logoAmika"></img>
                </th>

                <th>
                    <a  href="homepage.php" style="text-decoration:none;"> 
                        <img src="imagens\home.png" alt="Home Icon" class="IconHeader"></img>
                        <p class="hyperlink">MENU</p> 
                    </a>
                </th>

                

            </tr>

        </table>
    </header>

        <form action="register.php" method="POST" autocomplete="on">

            <div>
                <label for="nome">Nome</label>
                <input type="text" placeholder="Introduza o seu Nome" name="nome" id="nome" required>

                <label for="idade">Idade</label>
                <input type="text" placeholder="Introduza a Sua idade" name="idade" id="idade" required>

                <label for="email">Email</label>
                <input type="text" placeholder="Introduza a seu email" name="email" id="email" required>


                <label for="psw">Palavra-passe</label>
                <input type="password" placeholder="Introduza a Palavra-passe" name="psw" id="psw" required>

                <label for="pswConfirm">Repita a Palavra-passe</label>
                <input type="password" placeholder="Repita a Palavra-passe" name="pswConfirm" id="pswConfirm" required>
  
                <label for="regiao" >Região</label>
                <select  name="regiao" id="regiao">
                    <option value="Barlavento">Barlavento</option>
                    <option value="Centro">Centro</option>
                    <option value="Sotavento">Sotavento</option>
                </select>

                <label for="tipoUser" >Tipo De Utilizador</label>
                <select onchange="JadiCheck(this)" name="tipoUser" id="tipoUser">
                    <option value="Voluntario">Voluntário</option>
                    <option value="Jadi">Jovem Adulto com Deficiência Intelectual</option>
                </select>

                <div id="TextoJadi" style="display: none;">
                    <label for="deficiencia">Descreva a Deficiência: </label> 
                    <input type="text" id="deficiencia" name="deficiencia" />
                </div>

            </div>
            
                <button type="submit" class="Registar">Registar</button>

        </form>

</body>


<script type="text/javascript">
    function JadiCheck(that) {
    if (that.value == "Jadi") {
        document.getElementById("TextoJadi").style.display = "block";
    } else {
        document.getElementById("TextoJadi").style.display = "none";
    }
}
</script>