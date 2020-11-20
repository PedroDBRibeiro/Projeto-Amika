<?php
session_start();

if(isset($_GET['erro'])) {
if ('true' === $_GET['erro']) {
            echo '<script>alert("Login Incorreto")</script>'; 
            }
        }
?>

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
                        
                        <a  href="Profile.php" style="text-decoration:none;"> 
                            <img src="imagens\profile.png" alt="Profile Icon" class="IconHeader"></img>
                            <p class="hyperlink">PERFIL</p> 
                        </a>
                        
                    </th>

                    <th>
                        <img src="Imagens\LogoAmika.png" alt="Logo Amik@" class="logoAmika"></img>
                    </th>

                    <th>
                        <a  href="" style="text-decoration:none;"> 
                            <img src="imagens\home.png" alt="Home Icon" class="IconHeader"></img>
                            <p class="hyperlink">MENU</p> 
                        </a>
                    </th>

                    <th>
                        <a  data-toggle="modal" data-target="#myModal" style="width:auto;" style="text-decoration:none;">
                            <img src="imagens\login.png" alt="Login Icon" class="IconHeader"></img>
                            <p class="hyperlink">ENTRAR</p> 
                        </a>

                        <a  href="" style="text-decoration:none;">
                            <img src="imagens\Logout.png" alt="Logout Icon" class="IconHeader"></img>
                            <p class="hyperlink">SAIR</p> 
                        </a>
                    </th>

                </tr>

            </table>

        </header>

        <table class="tabelaBody">
            <tr>
                

                <th>
                    <a  href="" style="text-decoration:none;">
                        <img src="imagens\Agenda.png" alt="Agenda Icon" class="Icon"></img>
                        <p class="hyperlink">AGENDA</p> 
                    </a>
                </th>

                <th>
                        <a  href="" style="text-decoration:none;">
                            <img src="imagens\Forum.png" alt="Forum Icon" class="Icon"></img>
                            <p class="hyperlink">FORUM</p> 
                        </a>
                </th>

                <th>
                    <a  href="" style="text-decoration:none;">
                            <img src="imagens\Chat.png" alt="Chat Icon" class="Icon"></img>
                            <p class="hyperlink">CHAT</p> 
                    </a>
                </th>
                    
                <th>
                    <a  href="" style="text-decoration:none;">
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
                        <a  href="" style="text-decoration:none;">
                            <img src="imagens\pontos_interesse.png" alt="Pontos de Interesse Icon" class="Icon"></img>
                            <p class="hyperlink">PONTOS DE INTERESSE</p> 
                        </a>
                    </th>

                    <th>
                        <a  href="" style="text-decoration:none;">
                            <img src="imagens\apoio_voluntarios.png" alt="Apoio a VOluntários Icon" class="Icon"></img>
                            <p class="hyperlink">APOIO A VOLUNTÁRIOS</p> 
                        </a>
                    </th>
            </tr>
        </table>
 
        

    

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
                        <form class="modal-content animate" action="authenticate.php">
                                <div class="container">
                                    <label for="uname"><b>Utilizador</b></label>
                                        <input type="text" placeholder="Inserir Utilizador" name="username" required>

                                    <label for="psw"><b>Palavra-Passe</b></label>
                                        <input type="password" placeholder="Inserir Palavra-passe" name="psw" required>

                                    <button type="submit">Entrar</button>
                                    <label>
                                        <input type="checkbox" checked="checked" name="remember"> Lembrar-me
                                    </label>
                                    <a style="text-decoration:underline;" href="signup.php"><br>Inscrever-me</a>
                                    
                                </div>
                        </form> 
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                
                
                </div>
            </div>
        </div>
        



    </body>
</html>