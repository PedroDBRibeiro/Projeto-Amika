<?php

// PÁGINA PARA SELECIONAR CIDADES E VER OS PONTOS DE INTERESSE NESSA CIDADE

include "config.php";

session_start();

include('newHeader.php');

//vai buscar as cidades que existem de momento na BD para aparecerem no dropdown menu
$qcidades = "SELECT DISTINCT cidade FROM pontos_interesse;";

$result = mysqli_query($mysqli, $qcidades);

while ($found = mysqli_fetch_assoc($result)) {
    $cidades[] = $found;
}


?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pontos de Interesse</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">

</head>

<style>
    /* CSS */
    button {

        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }
</style>

<body>

    <!-- TÍTULO -->
    <div align="center" style="margin-top:80px;">
        <div class="title-back">
            <h1 class="title ">
                Pontos de Interesse
            </h1>
        </div>
    </div>

    <div>
        <p style=" text-align: center;font-family: 'Chewy'; margin-top: 20px;font-size: 20px;">
            Seleciona uma cidade para veres todos os sítios mais interessantes para visitar!
        </p>
    </div>


    <div class="center" class="bg-primary" style="height:225px; border-radius:10px;background: linear-gradient(#e8e6e6,#dbd9d9)">
        <div align="center" style="padding-top:30px;margin-top:45px;">
            <form action='escolhercidade.php' method=post>
                <select name="myvalue">
                    <div id="myDropdown" class="dropdown-content">
                        <!-- Mostra as cidades existentes na BD -->
                        <?php foreach ($cidades as $cidade) : ?>
                            <option type="button" value="<?php echo $cidade['cidade']; ?>"><?php echo $cidade['cidade']; ?></option>
                        <?php endforeach; ?>
                </select>
        </div><br>
        <div style="width:100%;margin-left:auto;margin-right:auto;">
            <button type="submit" name="submit" value="Pesquisar" style="font-family: 'Chewy';color: #03036B;margin-top:15px; background-image: linear-gradient(to right, #fbb034 0%, #ffdd00 74%);">
                Pesquisar</button>
        </div>
        </form>
    </div>
    </div>


    <style>
        /* CSS */
        .dropdown {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 17%;
        }

        * {
            margin: 0;
            padding: 0;
        }


        select {
            color: #05056c;
            border: 1px solid rgba(110, 130, 208, .18);
            font-size: 29px;
            font-family: 'Chewy';
            text-align: center;
            margin-top: 20px;
            padding: 4px 18px;
        }

        input[type=submit] {
            color: #03036B;
            background: linear-gradient(to right, #fbb034 0%, #ffdd00 74%);
            font-size: 25px;
            margin-top: 20px;
            border-radius: 25px;
            padding: 5px;
            border-color: #03036B;
            font-family: 'Chewy';
            text-align: center;
        }
    </style>

    <script>
        /* Quando o user clica no botão, alterna entre mostrar os conteúdos do dropdown e esconder */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Se o utilizador clicar fora do dropdown, ele fecha
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

</body>

</html>