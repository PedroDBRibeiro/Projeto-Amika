<?php
include "config.php";

session_start();

include('newHeader.php');



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
        <link rel="stylesheet" type="text/css" href="CSS/Login.css">
    </head>

    <body>


    <div align ="center" style="margin-top:50px;">
        <div class="title-back" >
            <h1 class = "title ">
                Pontos de Interesse
            </h1>
        </div>
    </div>

        <div>
            <p style=" text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top: 20px;font-size: 20px;">
                Seleciona uma cidade para veres todos os s&iacutetios mais interessantes para visitar!
            </p>
        </div>

        
    <div class="center" class="bg-primary" style="height:225px; border-radius:10px;background: linear-gradient(#e8e6e6,#dbd9d9)">         
        <div align="center" style ="padding-top:30px;">                
            <form action='escolhercidade.php' method=post>
                    <select name="myvalue">
                        <div id="myDropdown" class="dropdown-content">
                            <option type="button" value="Faro">Faro</option>
                            <option type="button" value="Albufeira">Albufeira</option>
                            <option type="button" value="Lagoa">Lagoa</option>
                            <option type="button" value="Vilamoura">Vilamoura</option>
                            <option type="button" value="Portimao">Portimão</option>
                            <option type="button" value="Tavira">Tavira</option>
                            <option type="button" value="Monte Gordo">Monte Gordo</option>
                            <option type="button" value="Loule">Loul&eacute</option>
                            <option type="button" value="Olhao">Olh&atildeo</option>
                            <option type="button" value="Silves">Silves</option>                      
                    </select> 
                        </div><br>
                    <div style="width:100%;margin-left:auto;margin-right:auto;">
                    <button type="submit" name="submit"  value="Pesquisar" style="color: #03036B;margin-top:15px; background-image: linear-gradient(to right, #fbb034 0%, #ffdd00 74%);">
                    Pesquisar</button>
                    </div>
                </form>        
        </div>
    </div>


     

        <style>
        
            .dropdown{
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 17%;
            }
                *{
                    margin: 0;
                    padding: 0;
            }
    

            select{
                color: #05056c;
                border: 1px solid  rgba(110,130,208, .18);
                font-size: 30px;
                font-family: 'Chewy'; 
                text-align: center;
                margin-top: 20px;
                padding: 4px 18px;
            }
            
            input[type=submit]{
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
            /* When the user clicks on the button, 
            toggle between hiding and showing the dropdown content */
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

            // Close the dropdown if the user clicks outside of it
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


