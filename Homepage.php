<?php

include('config.php');

session_start();

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

?>

<!DOCTYPE html>

<html>
    <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Projeto Amik@</title>
            <meta name="description" content=""
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="">

            <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
            <link rel="stylesheet" type="text/css" href="CSS/Login.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src ="tempo.js"></script>

            

    </head>

    <body onload="diaSemana()" >

    <header>
            <table class="tabelaHeader" >
                <tr>
                    <th>

                <?php 
                   if(isset($_SESSION['loggedin'])){
         ?> 
                        <a href="profile.php?search_result=<?php echo $_SESSION['user_id']; ?>" style="text-decoration:none;"> 
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
                        <a href="Homepage.php">
                        <img src="Imagens\LogoAmika.png" alt="Logo Amik@" class="logoAmika"></img>
                        </a>
                    </th>
                    <th>
                    
                   <!-- <a  href="homepage.php" style="text-decoration:none;"> 
                        <img src="imagens\home.png" alt="Home Icon" class="IconHeader"></img>
                        <p class="hyperlink">MENU</p> 
                    </a>
                    -->                     
                    </th>
                    <th>
                        <?php 
                            if(isset($_SESSION['loggedin'])){
                        ?> 
                                    <a  href="logout.php" style="text-decoration:none;">
                                        <img src="imagens\Logout.png" alt="Logout Icon" class="IconHeader"></img>
                                        <p class="hyperlink">SAIR</p> 
                                    </a>
                        <?php }

                        else{ ?> <!-- data-toggle="modal" data-target="#myModal"-->
                        <a   data-toggle="modal" data-target="#myModal"  style="width:auto;" style="text-decoration:none;">
                            <img src="imagens\login.png" alt="Login Icon" class="IconHeader"></img>
                            <p class="hyperlink">ENTRAR</p> 
                        </a>
                        <?php 
                            } 
                        ?>                      
                    </th>
                </tr>
            </table>
        </header>

        
<!-- API TEMPO -->

<?php

$weatherData = json_decode(file_get_contents("http://api.ipma.pt/open-data/forecast/meteorology/cities/daily/1080500.json"),true);
$weatherTypes = json_decode(file_get_contents("https://api.ipma.pt/open-data/weather-type-classe.json"),true);

for ($i = 0; $i < count($weatherData);$i++){
     
    $data[$i]=$weatherData['data'][$i]['forecastDate'];
    $tMax[$i]=$weatherData['data'][$i]['tMax'];
    $tMin[$i]=$weatherData['data'][$i]['tMin'];
    $idWeatherType[$i]=$weatherData['data'][$i]['idWeatherType'];
   
   }
   for ($i = 1; $i < 29;$i++){
   $weatherType[$i]=$weatherTypes['data'][$i]['descIdWeatherTypePT'];
   }

?>
        <table class="tabelaBody">
            <tr>
                <th>
                    <a  href="calendar.php" style="text-decoration:none;">
                        <img src="imagens\Agenda.png" alt="Agenda Icon" class="Icon"></img>
                        <p class="hyperlink">AGENDA</p> 
                    </a>
                </th>

                <th> 
                        <a  href="forum.php" style="text-decoration:none;">
                            <img src="imagens\Forum.png" alt="Forum Icon" class="Icon"></img>
                            <p class="hyperlink">FORUM</p> 
                        </a>
                </th>

                <th>
                    <a  href="chat/index.php" style="text-decoration:none;">
                            <img src="imagens\Chat.png" alt="Chat Icon" class="Icon"></img>
                            <p class="hyperlink">CHAT</p> 
                    </a>
                </th>
                    
                <th>
                    <a  href="search.php" style="text-decoration:none;">
                        <img src="imagens\Pesquisar.png" alt="Pesquisar Icon" class="Icon"></img>
                        <p class="hyperlink">PESQUISAR</p> 
                    </a>
                </th>
                    
                    <th>
                        <a  href="" style="text-decoration:none;">
                            <img src="imagens\Exercicios.png" alt="Exercicios Icon" class="Icon"></img>
                            <p class="hyperlink">EXERCICIOS</p> 
                        </a>
                    </th>
                
            </tr>

            <tr>
                    <th>
                    </th>

                    <th>
                        <a  href="" style="text-decoration:none;">
                            <img src="imagens\Emergencia.png" alt="Emergencia Icon" class="Icon"></img>
                            <p class="hyperlink">DICAS EMERGÊNCIA</p> 
                        </a>
                    </th>

                    <th>
                        <a  href="informacoes.php" style="text-decoration:none;">
                            <img src="imagens\informacoes.png" alt="Informações Icon" class="Icon"></img>
                            <p class="hyperlink">INFORMAÇÕES</p> 
                        </a>
                    </th>
 
                    <th>
                        <a  href="pontosinteresse.php" style="text-decoration:none;">
                            <img src="imagens\pontos_interesse.png" alt="Pontos de Interesse Icon" class="Icon"></img>
                            <p class="hyperlink">PONTOS DE INTERESSE</p> 
                        </a>
                    </th>

                    <th>
                        <a  href="apoiovoluntarios.php" style="text-decoration:none;">
                            <img src="imagens\apoio_voluntarios.png" alt="Apoio a VOluntários Icon" class="Icon"></img>
                            <p class="hyperlink">APOIO A VOLUNTÁRIOS</p> 
                        </a>
                    </th>
            </tr>
        </table>
 
     <!--CARTÃO TEMPO-->   
    <div class="container">
    <div class="padding" >        
            <div class="col-lg-8 grid-margin stretch-card" >
                <div class="card card-weather" style="width:1000px;">
                    <div class="card-body">
                        <div class="weather-date-location">
                            <h3  id="hoje">
                                </h3>
                            <p class="text-gray"> <span class="weather-date"><?php echo $data[0] ?>,</span> <span class="weather-location">Faro, Portugal</span> </p>
                        </div>
                        <div class="weather-data d-flex">
                            <div class="mr-auto">
                                <h4 class="display-4"><?php echo $tMax[0]?> <span class="symbol">°</span>C</h4>
                                <h4 class="display-4" style="opacity: 0.6;"><?php echo $tMin[0]?> <span class="symbol">°</span>C</h4>
                                <p> <?php echo $weatherType[$idWeatherType[0] + 1] ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex weakly-weather">
                            <div class="weakly-weather-item">
                                <p class="mb-0" id="amanhã" ></p> <i class="mdi mdi-weather-cloudy"></i>
                                <p class="mb-0"> <?php echo $tMax[1]?>º</p>
                                <p class="mb-0" style ="opacity: 0.7;"> <?php echo $tMin[1]?>º </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1" id=DPSamanha> </p> <i class="mdi mdi-weather-hail"></i>
                                <p class="mb-0"> <?php echo $tMax[2]?>º</p>
                                <p class="mb-0" style ="opacity: 0.7;"> <?php echo $tMin[2]?>º </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"id=DPSamanha2>  </p> <i class="mdi mdi-weather-partlycloudy"></i>
                                <p class="mb-0"> <?php echo $tMax[3]?>º</p>
                                <p class="mb-0" style ="opacity: 0.7;"> <?php echo $tMin[3]?>º </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1"id=DPSamanha3>  </p> <i class="mdi mdi-weather-pouring"></i>
                                <p class="mb-0"> <?php echo $tMax[4]?>º</p>
                                <p class="mb-0" style ="opacity: 0.7;"> <?php echo $tMin[4]?>º </p>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>
<!--FIM CARTÃO TEMPO-->

    

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
            
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">ENTRAR</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
               
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="modal-content animate" action ="chat/login.php" method="POST">
                                <div class="container"> 
                                    <label for="emailLogin"><b>Email</b></label>
                                        <input type="text" placeholder="Inserir Email" name="email" required>

                                    <label for="pswLogin"><b>Palavra-Passe</b></label>
                                        <input type="password" placeholder="Inserir Palavra-passe" name="password" required>

                                    <button type="submit" name ="login" value ="Login">Entrar</button>
                                    <label>
                                        <input type="checkbox" checked="checked" name="remember"> Lembrar-me
                                    </label>
                                    <a style="text-decoration:underline;" href="PaginaRegisto.php"><br>Inscrever-me</a>
                                    
                                </div>
                        </form> 
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                
                
                </div>
            </div>
        </div>
        
        




    </body>
</html>