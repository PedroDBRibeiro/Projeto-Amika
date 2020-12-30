<?php

session_start();
include "config.php";
include('newHeader.php');

?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Projeto Amik@</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">

    <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
    <link rel="stylesheet" type="text/css" href="CSS/Login.css">
    <link rel="stylesheet" type="text/css" href="CSS/searchCard.css">
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


    <div align ="center" style="margin-top:50px;">
        <div class="title-back" >
            <h1 class = "title ">
                Pesquisar
            </h1>
        </div>
    </div>

    <div>
        <p style=" text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top: 20px;font-size: 20px;">
            Nesta página podes encontrar outros utilizadores com quem poderás fazer atividades!
            <br> Para isso, introduz a tua localização e os teus hobbies favoritos.
        </p>

    </div>


    <div class="center" class="bg-primary" style="height:225px; border-radius:10px;background: linear-gradient(#e8e6e6,#dbd9d9)">
        <form id="search" method="post" action="search.php">
            <div style="float:right;padding:10px;padding-right:80px;margin-top:40px;">

                <?php
                $query = "SELECT DISTINCT hobbie FROM hobbies;";
                $result = mysqli_query($mysqli, $query);

                while ($found = mysqli_fetch_assoc($result)) {
                    $hobbies_selected[] = $found;
                }

                ?>

                <label class="text-primary">Hobbies</label><br>
                <select name="hob[]" class="selectpicker" multiple="multiple" title="Escolhe 1 ou mais opções">
                    <?php foreach ($hobbies_selected as $hobbie) : ?>
                        <option value="<?php echo $hobbie['hobbie'] ?>">
                            <?php echo $hobbie['hobbie'] ?>
                        </option>
                    <?php endforeach; ?>
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
                <button type="submit" name="submit" form="search" value="Pesquisar" style="color: #03036B;margin-top:15px;background-image: linear-gradient(to right, #fbb034 0%, #ffdd00 74%)">
                    Pesquisar</button>
            </div>
        </form>
    </div>

    </div>

    <?php include("location&hobbies.php");
    
    if (isset($_POST['submit'])) {?>

        <div style="background: linear-gradient(#ffff00,#ffd769); width: 20%; margin-top:50px; border-radius: 25px; padding: 5px;" class="center">
            <h3 style="font-family: 'Chewy'; text-align: center; color: #03036B; font-size: 32px; ">
                Resultados
            </h3>
        </div>

        <p style=" text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top: 20px;font-size: 20px;">
            <?php if(isset($no_results)) echo $no_results; ?>
        </p>

    <?php }  ?>
    <br><br>
    <table style=" margin:auto;">
        <tr>
            <div>
                <?php foreach ($search_results as $search_result) : ?>
                    <td>
                        <div class="col-sm-6 col-md-4 col-xs-12 py-2" >
                                <div class="card  mx-2 mb-3" style="width: 18rem;height:25 rem;">
                                    <img class="card-img-top"  alt="Card image"<?php echo 'src="data:image/jpeg;base64,' . base64_encode($search_result['avatar']) . '"' ?>>
                                        <div class="card-body">
                                            <h4 class="card-title" ><?php echo "<b>".$search_result['nome']."</b>"?></h4>
                                            <p class="card-text"><?php echo "<b>Hobbies em comum: </b>".$search_result['allhobbies']. "<br><br><b>Localização: </b>" . $search_result['REGIAO']; ?></p>
                                        </div>
                                            <div style="padding: 10px;"><a href="profile.php?search_result=<?php echo $search_result['user_id']; ?>" class="btn search-btn btn-rounded btn-sm my-0" style="display:block;margin:auto;color:white;">Ver Perfil</a></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </td>
                <?php endforeach; ?>
            </div>
        </tr>
    </table>

            
</body>

</html>