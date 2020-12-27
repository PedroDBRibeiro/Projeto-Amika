<?php

session_start();
include "config.php";
include('header.php');

?>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');

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
           <br> Para isso, introduz a tua localização e os teus hobbies favoritos.
        </p>
        
    </div>


    <div class="center" class="bg-primary" style="height:225px; border-radius:10px;background: linear-gradient(#e8e6e6,#dbd9d9)">
        <form id="search1" method="post" action="search.php">
            <div style="float:right;padding:10px;padding-right:80px;margin-top:40px;">
                <label class="text-primary">Hobbies</label><br>
                <select name="hob[]" class="selectpicker" multiple="multiple" title="Escolhe 1 ou mais opções">
                    <option value="Praia">Praia</option>
                    <option value="Passear">Passear</option>
                    <option value="Futebol">Futebol</option>
                    <option value="Desporto">Desporto</option>
                    <option value="Series/Filmes">Series/Filmes</option>
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
                    <option disabled selected value>Escolhe uma opção</option>
                    <option value="Sotavento">Sotavento</option>
                    <option value="Barlavento">Barlavento</option>
                    <option value="Centro">Centro</option>
                </select>


            </div>

            <div style="width:100%;margin-left:auto;margin-right:auto;">
                <button type="submit" name="submit1" form="search1" value="Pesquisar" style="margin-top:15px;background: linear-gradient(#ffff00,#ffd769); color: #03036B">
                    Pesquisar</button>
            </div>
        </form>
    </div>

    </div>

    <?php include("location&hobbies.php"); 
    
    if (isset($_POST['submit1'])) {?>

    <div style="background: linear-gradient(#ffff00,#ffd769); width: 20%; margin-top:50px; border-radius: 25px; padding: 5px;" class="center">
        <h3 style="font-family: 'Chewy'; text-align: center; color: #03036B; font-size: 32px; ">
           Resultados
        </h3>
    </div>

    <?php } ?>
    <br><br>
    <table style=" margin:auto;">
        <tr>
            <div>
                <?php foreach ($search_results as $search_result) : ?>
                    <td>
                        <div class="col-sm-6 col-md-4 col-xs-12 py-2">
                                <div class="card card-body mx-2 mb-3" style="width: 22rem; height: 28rem; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%); border-radius:10px; border: 1px #fbd72b;">
                                    <img class="card-img-top" style="width: 18rem; height: 12rem; border-radius:10px; display:block; margin:auto;" alt="Card image"<?php echo 'src="data:image/jpeg;base64,' . base64_encode($search_result['avatar']) . '"' ?>>
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo "<b>".$search_result['nome']."</b>"?></h4>
                                            <p class="card-text"><?php echo "<b>Hobbies em comum: </b>".$search_result['allhobbies']. "<br><br><b>Localização: </b>" . $search_result['REGIAO']; ?></p>
                                        </div>
                                            <div style="padding: 10px;"><a href="" class="btn btn-primary" style="display:block;margin:auto;">Ver Perfil</a></div>
                                    </div>
                                </div>
                            </td>       
                        <?php endforeach; ?>
                    </div>
                </tr>
            </table> 


</body>

</html>