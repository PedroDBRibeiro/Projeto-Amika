<html>

<?php
include "config.php";

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Projeto Amik@</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">

    <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
    <link rel="stylesheet" type="text/css" href="CSS/Login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</head>

<header>

    <table class="tabelaHeader">

        <tr>
            <th>

                <a href="Profile.php" style="text-decoration:none;">
                    <img src="imagens\profile.png" alt="Profile Icon" class="IconHeader"></img>
                    <p class="hyperlink">PERFIL</p>
                </a>

            </th>

            <th>
                <img src="Imagens\LogoAmika.png" alt="Logo Amik@" class="logoAmika"></img>
            </th>

            <th>
                <a href="" style="text-decoration:none;">
                    <img src="imagens\home.png" alt="Home Icon" class="IconHeader"></img>
                    <p class="hyperlink">MENU</p>
                </a>
            </th>

            <th>
                <a data-toggle="modal" data-target="#myModal" style="width:auto;" style="text-decoration:none;">
                    <img src="imagens\login.png" alt="Login Icon" class="IconHeader"></img>
                    <p class="hyperlink">ENTRAR</p>
                </a>

                <a href="" style="text-decoration:none;">
                    <img src="imagens\Logout.png" alt="Logout Icon" class="IconHeader"></img>
                    <p class="hyperlink">SAIR</p>
                </a>
            </th>

        </tr>

    </table>

</header>

<body>
    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 45%;
            margin-top: 50px;

        }
    </style>

    <script>
        /*$('.mdb-select').materialSelect({
});*/
    </script>


    <div style="background: linear-gradient(#ffff00,#ffd769); width: 25%; margin-top:50px; border-radius: 25px; padding: 5px;" class="center">
        <h1 style="font-family: 'Chewy'; text-align: center; color: #03036B; font-size: 48px; ">
            Pesquisa
        </h1>
    </div>

    <div>
        <p style=" text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top: 20px;font-size: 20px;">
            Nesta página podes encontrar outros utilizadores com quem poderás fazer atividades!
            Para isso, introduz a tua localização e os teus hobbies favoritos.
        </p>
    </div>


    <div class="center" class="bg-primary" style="height:225px; border-radius:10px;background: linear-gradient(#e8e6e6,#dbd9d9)">
        <form id="search1" method="post" action="search.php">
            <div style="float:right;padding:10px;padding-right:80px;margin-top:40px;">
                <label class="text-primary">Hobbies</label><br>
                <select name="hob[]" class="selectpicker" multiple="multiple">
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
            </div>



            <div style="float:left;padding:10px;padding-left:80px;margin-top:40px;">

                <label class="text-primary">Localização</label><br>
                <select name="local" class="selectpicker">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="Sotavento">Sotavento</option>
                    <option value="Barlavento">Barlavento</option>
                    <option value="Centro">Centro</option>
                </select>


            </div>

            <div style="width:100%;margin-left:auto;margin-right:auto;">
                <button type="submit" name="submit" form="search1" value="Pesquisar" style="margin-top:15px;background: linear-gradient(#ffff00,#ffd769); color: #03036B">
                    Pesquisar</button>
            </div>
        </form>
    </div>

    </div>

    <?php include("location&hobbies.php"); ?>

    <div>
        <?php foreach ($search_results as $search_result) : ?>
            <p> <?php echo $search_result['nome'] . " " . $search_result['allhobbies'] . " " . $search_result['REGIAO']; ?> </p>
        <?php endforeach; ?>
    </div>



</body>

</html>