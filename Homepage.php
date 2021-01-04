<?php

include('config.php');
session_start();
include('newHeader.php');


/*if(isset($_GET['erro'])) {
if ('true' === $_GET['erro']) {
            echo '<script>alert("Login Incorreto")</script>'; 
            }
        }
    */

if (isset($_GET["msg"]) && $_GET["msg"] == 'failedPass') {
    echo '<script language="javascript">';
    echo 'alert("Wrong Password")';
    echo '</script>';
}

if (isset($_GET["msg"]) && $_GET["msg"] == 'failedEmail') {
    echo '<script language="javascript">';
    echo 'alert("Wrong Email")';
    echo '</script>';
}


if (isset($_SESSION['loggedin'])) {

    $session_id = $_SESSION['user_id'];

    $query_lemb = "SELECT users_act.* , u.nome as NOME, c.CATEGORIA from (
        select ID_ATIVIDADE, ID_CATEGORIA, id_user2 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id
        union
        select ID_ATIVIDADE, ID_CATEGORIA, id_user1 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id) as users_act
        join utilizadores as u 
        on users_act.id=u.user_id
        join categoria as c
        on users_act.ID_CATEGORIA = c.ID_CATEGORIA
    where users_act.id <> $session_id 
    AND users_act.DATA_INICIO <= DATE_ADD(NOW(), INTERVAL 24 HOUR)
    AND users_act.DATA_INICIO >= NOW()
    ORDER BY users_act.DATA_INICIO ASC;";

    $result = mysqli_query($mysqli, $query_lemb);

    while ($found = mysqli_fetch_assoc($result)) {
        $prox_atividades[] = $found;
    }

    $query_lemb2 = "SELECT users_act.* , u.nome as NOME, c.CATEGORIA from (
        select ID_ATIVIDADE, ID_CATEGORIA, id_user2 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id
        union
        select ID_ATIVIDADE, ID_CATEGORIA, id_user1 as id, DATA_INICIO, DATA_FIM, DESCRICAO from atividades as a
        where a.id_user1 = $session_id OR a.id_user2 = $session_id) as users_act
        join utilizadores as u 
        on users_act.id=u.user_id
        join categoria as c
        on users_act.ID_CATEGORIA = c.ID_CATEGORIA
    where users_act.id <> $session_id 
    ORDER BY users_act.DATA_INICIO ASC
    LIMIT 4;";

    $result2 = mysqli_query($mysqli, $query_lemb2);

    while ($found2 = mysqli_fetch_assoc($result2)) {
        $prox_atividades2[] = $found2;
    }
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Projeto Amik@</title>
    <meta name="description" content="" <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="tempo.js"></script>

    <?php if (isset($_SESSION['loggedin'])) : ?>
        <?php if (!empty($prox_atividades) && $_SESSION['lembretes'] == 0) : ?>
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#lembretes').modal('show');
                });
            </script>
        <?php endif;
        $_SESSION['lembretes'] = 1; ?>
    <?php endif; ?>



</head>


<body onload="diaSemana()" style="background-color: #aecad6;
background-image: linear-gradient(315deg, #aecad6 0%, #b8d3fe 74%);
">

    <!-- API TEMPO -->

    <?php

    $weatherData = json_decode(file_get_contents("http://api.ipma.pt/open-data/forecast/meteorology/cities/daily/1080500.json"), true);
    $weatherTypes = json_decode(file_get_contents("https://api.ipma.pt/open-data/weather-type-classe.json"), true);

    for ($i = 0; $i < count($weatherData); $i++) {

        $data[$i] = $weatherData['data'][$i]['forecastDate'];
        $tMax[$i] = $weatherData['data'][$i]['tMax'];
        $tMin[$i] = $weatherData['data'][$i]['tMin'];
        $idWeatherType[$i] = $weatherData['data'][$i]['idWeatherType'];
    }
    for ($i = 1; $i < 29; $i++) {
        $weatherType[$i] = $weatherTypes['data'][$i]['descIdWeatherTypePT'];
    }

    ?>


    <!--CARTÃO TEMPO-->
    <div class="container d-flex" style="font-family: 'Chewy';margin-bottom:70px;margin-top:50px;">
        <div class="padding" style="float:left;">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card card-weather" style="width:600px;border-radius:20px;opacity:0.9;">
                    <div class="card-body" style="height:250px;">
                        <div class="weather-date-location">
                            <h3 id="hoje" style="font-family: 'Chewy'; ">
                            </h3>
                            <p class="text-gray"> <span class="weather-date"><?php echo $data[0] ?>,</span> <span class="weather-location">Faro, Portugal</span> </p>
                        </div>
                        <div class="weather-data d-flex">
                            <div class="mr-auto">
                                <h1 class="display-5" style="font-family: 'Chewy'; "><?php echo $tMax[0] ?> <span class="symbol">°</span>C</h1>
                                <h1 class="display-5" style="opacity: 0.6;font-family: 'Chewy';"><?php echo $tMin[0] ?> <span class="symbol">°</span>C</h1>
                                <p> <?php echo $weatherType[$idWeatherType[0] + 1] ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0" style="border-radius:20px;">
                        <div class="d-flex weakly-weather" style="border-radius:20px;">
                            <div class="weakly-weather-item">
                                <p class="mb-0" id="amanhã"></p>
                                <p class="mb-0"> <?php echo $tMax[1] ?>º</p>
                                <p class="mb-0" style="opacity: 0.7;"> <?php echo $tMin[1] ?>º </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1" id=DPSamanha> </p>
                                <p class="mb-0"> <?php echo $tMax[2] ?>º</p>
                                <p class="mb-0" style="opacity: 0.7;"> <?php echo $tMin[2] ?>º </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1" id=DPSamanha2> </p>
                                <p class="mb-0"> <?php echo $tMax[3] ?>º</p>
                                <p class="mb-0" style="opacity: 0.7;"> <?php echo $tMin[3] ?>º </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1" id=DPSamanha3> </p>
                                <p class="mb-0"> <?php echo $tMax[4] ?>º</p>
                                <p class="mb-0" style="opacity: 0.7;"> <?php echo $tMin[4] ?>º </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRÓXIMOS 3 EVENTOS -->
        <div class="float-right" class="container d-flex" style="width:430px;margin-left:30px;margin-top:10px;">
            <div class="row justify-content-md-center" style="font-size:25px;"> PRÓXIMOS EVENTOS: </div>
            <?php if (isset($_SESSION['loggedin'])) foreach ($prox_atividades2 as $prox_atividade2) : ?>
                <div class="row justify-content-md-center" style="background:white;height:60px;border-radius:20px;margin-top:18px;padding:18px;">
                    <i class="fas fa-exclamation-circle"></i>&nbsp;
                    <?php echo $prox_atividade2['CATEGORIA'] ?> com o utilizador <?php echo $prox_atividade2['NOME']; ?> no dia <?php setlocale(LC_TIME, 'pt', 'pt.utf-8', 'pt.utf-8', 'portuguese');
                                                                                                                                date_default_timezone_set('Europe/Lisbon');
                                                                                                                                $data = utf8_encode(strftime('%d de %B', strtotime($prox_atividade2['DATA_INICIO'])));
                                                                                                                                echo $data; ?> às <?php setlocale(LC_TIME, 'pt', 'pt.utf-8', 'pt.utf-8', 'portuguese');
                                                                                                                                                    date_default_timezone_set('Europe/Lisbon');
                                                                                                                                                    $horas = utf8_encode(strftime('%R', strtotime($prox_atividade2['DATA_INICIO'])));
                                                                                                                                                    echo $horas; ?>
                </div>
            <?php endforeach;
                if(!isset($_SESSION['loggedin'])) echo "<div class='row justify-content-md-center'>Entra na tua conta para veres as próximas atividades!</div>";
            ?>

        </div>
    </div>
    <!--FIM CARTÃO TEMPO-->

    <!-- ÍCONES -->
    <div class="container" align="center" style="font-family: 'Chewy'; opacity:0.9;">
        <div class="row justify-content-md-center" style="margin-top:50px;">
            <?php if (isset($_SESSION['loggedin'])) {
            ?>
                <div class="col-sm-2 ">
                    <a href="calendar.php" style="text-decoration:none;">
                        <img style="margin-top:30px;" src="imagens\Agenda.png" alt="Agenda Icon" class="Icon"></img>
                        <br><br><b class="hyperlink">AGENDA</b><br><br>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="chat/index.php" style="text-decoration:none;">
                        <img style="margin-top:30px;" src="imagens\Chat.png" alt="Chat Icon" class="Icon"></img>
                        <br><br><b class="hyperlink">CHAT</b> <br><br>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="search.php" style="text-decoration:none;">
                        <img style="margin-top:30px;" src="imagens\Pesquisar.png" alt="Pesquisar Icon" class="Icon"></img>
                        <br><br><b class="hyperlink">PESQUISAR</b> <br><br>
                    </a>
                </div>
            <?php } ?>
            <div class="col-sm-2">
                <a href="forum.php" style="text-decoration:none;">
                    <img style="margin-top:30px;" src="imagens\Forum.png" alt="Forum Icon" class="Icon"></img>
                    <br><br><b class="hyperlink">FÓRUM</b> <br><br>
                </a>
            </div>

            <div class="col-sm-2">
                <a href="informacoes.php" style="text-decoration:none;">
                    <img style="margin-top:30px;" src="imagens\informacoes.png" alt="Informações Icon" class="Icon"></img>
                    <br><br><b class="hyperlink">INFORMAÇÕES</b> <br><br>
                </a>
            </div>


        </div>
        <br>
        <div class="row justify-content-md-center">
            <div class="col-sm-2">
                <a href="" style="text-decoration:none;">
                    <img style="margin-top:30px;" src="imagens\Emergencia.png" alt="Emergencia Icon" class="Icon"></img>
                    <br><br><b class="hyperlink">DICAS EMERGÊNCIA</b> <br><br>
                </a>
            </div>


            <div class="col-sm-2">
                <a href="" style="text-decoration:none;">
                    <img style="margin-top:30px;" src="imagens\Exercicios.png" alt="Exercicios Icon" class="Icon"></img>
                    <br><br><b class="hyperlink">EXERCÍCIOS</b> <br><br>
                </a>
            </div>

            <div class="col-sm-2">
                <a href="pontosinteresse.php" style="text-decoration:none;">
                    <img style="margin-top:30px;" src="imagens\pontos_interesse.png" alt="Pontos de Interesse Icon" class="Icon"></img>
                    <br><br><b class="hyperlink">PONTOS DE INTERESSE</b> <br><br>
                </a>
            </div>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['jadi'] == 0) {
            ?>
                <div class="col-sm-2">
                    <a href="apoiovoluntarios.php" style="text-decoration:none;">
                        <img style="margin-top:30px;" src="imagens\apoio_voluntarios.png" alt="Apoio a VOluntários Icon" class="Icon"></img>
                        <br><br><b class="hyperlink">APOIO A VOLUNTÁRIOS</b> <br><br>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>


    <!-- POPUP LEMBRETES -->
    <div class="modal fade" id="lembretes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size:27px; font-family: 'Chewy'; color: #03036B;">Lembretes!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php foreach ($prox_atividades as $prox_atividade) : ?>
                        <i class="fas fa-exclamation-circle"></i>&nbsp;
                        <?php echo $prox_atividade['CATEGORIA'] ?> com o utilizador <?php echo $prox_atividade['NOME']; ?> no dia <?php setlocale(LC_TIME, 'pt', 'pt.utf-8', 'pt.utf-8', 'portuguese');
                                                                                                                                    date_default_timezone_set('Europe/Lisbon');
                                                                                                                                    $data = utf8_encode(strftime('%d de %B', strtotime($prox_atividade['DATA_INICIO'])));
                                                                                                                                    echo $data; ?> às <?php setlocale(LC_TIME, 'pt', 'pt.utf-8', 'pt.utf-8', 'portuguese');
                                                                                                                                                        date_default_timezone_set('Europe/Lisbon');
                                                                                                                                                        $horas = utf8_encode(strftime('%R', strtotime($prox_atividade['DATA_INICIO'])));
                                                                                                                                                        echo $horas; ?>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tomei conhecimento</button>
                    <a href="calendar.php" class="btn btn-primary">Ir para a agenda</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>