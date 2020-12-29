<?php
include "config.php";

session_start();
include('header.php');


?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pontos de Interesse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
        
    </head>

    <body>

        <div class="dropdown">
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
                            <option type="button" value="Loule">Loulé</option>
                            <option type="button" value="Olhao">Olhão</option>
                            <option type="button" value="Silves">Silves</option>
                            <option type="button" value="Lagos">Lagos</option>

                        </div>
                    </select>
                    <input type=submit>
                </form>
        </div>

        <style>
        
            .dropdown {
                position: relative;
                display: inline-block;
                margin-left: 30px;
                font-size: 30px;
            
            }
    
            select{
                color: #05056c;
                border: 1px solid #05056c;
                font-size: 30px;
                font-family: Arial, Helvetica, sans-serif;
                margin-top: 20px;
                padding: 4px 18px;
            }
            
            input[type=submit]{
                color: #ffff00;
                background-color: #05056c;
                border: 4px solid #05056c;
                font-size: 25px;
                font-family: Arial, Helvetica, sans-serif;
                margin-top: 20px;
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


