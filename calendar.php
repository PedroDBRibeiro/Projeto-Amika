<?php

session_start();
include('newHeader.php');
include "config.php";

$session_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Agenda</title>
    <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="JS/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" integrity="sha512-o0rWIsZigOfRAgBxl4puyd0t6YKzeAw9em/29Ag7lhCQfaaua/mDwnpE2PVzwqJ08N7/wqrgdjc2E0mwdSY2Tg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.min.js" integrity="sha512-L0BJbEKoy0y4//RCPsfL3t/5Q/Ej5GJo8sx1sDr56XdI7UQMkpnXGYZ/CCmPTF+5YEJID78mRgdqRCo1GrdVKw==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" integrity="sha512-KXkS7cFeWpYwcoXxyfOumLyRGXMp7BTMTjwrgjMg0+hls4thG2JGzRgQtRfnAuKTn2KWTDZX4UdPg+xTs8k80Q==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />


    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({

                locale: 'pt',
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },

                //Carrega as atividades que já estão no calendário do utilizador
                events: 'load_activities.php',


                selectable: true,
                selectHelper: true,
                defaultDate: Date(),
                editable: true,
                navLinks: true,
                eventLimit: true,

                eventClick: function(event) {

                    $('#verAtividade #id').text(event.id);
                    $('#verAtividade #id').val(event.id);
                    $('#verAtividade #title').text(event.title);
                    $('#verAtividade #title2').val(event.title);
                    $('#verAtividade #amigo').text(event.nome_amigo);
                    $('#verAtividade #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
                    $('#verAtividade #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
                    $('#verAtividade #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
                    $('#verAtividade #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
                    $('#verAtividade #desc').text(event.desc);
                    $('#verAtividade').modal('show');

                },


                //Utilizador carrega num dia do calendário
                //Abre um popup para introduzir os detalhes da atividade
                select: function(start, end) {

                    $('#inserirAtividade #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
                    $('#inserirAtividade #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
                    $('#inserirAtividade').modal('show');

                },



                //Utilizador faz resize da atividade
                //Atualiza na BD a data inicio e fim da atividade


                /* eventResize: function(event) {
                     var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                     var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");
                     var title = event.title;
                     var id = event.id;
                     $.ajax({
                         url: "update_activities.php",
                         type: "POST",
                         data: {
                             title: title,
                             start: start,
                             end: end,
                             id: id
                         },
                         success: function() {
                             calendar.fullCalendar('refetchEvents');
                             alert('A hora da atividade foi atualizada!');
                         }
                     })
                 },

                 
                 eventDrop: function(event) {
                     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                     var title = event.title;
                     var id = event.id;
                     $.ajax({
                         url: "update_activities.php",
                         type: "POST",
                         data: {
                             title: title,
                             start: start,
                             end: end,
                             id: id
                         },
                         success: function() {
                             calendar.fullCalendar('refetchEvents');
                             alert("O dia da atividade foi atualizado!");
                         }
                     });
                 },*/



            });

        });

        function DataHora(evento, objeto) {
            var keypress = (window.event) ? event.keyCode : evento.which;
            campo = eval(objeto);

            if (campo.value == '00/00/0000 00:00:00') {
                campo.value = ""
            }

            caracteres = '0123456789';
            separacao1 = '/';
            separacao2 = ' ';
            separacao3 = ':';
            conjunto1 = 2;
            conjunto2 = 5;
            conjunto3 = 10;
            conjunto4 = 13;
            conjunto5 = 16;

            if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
                if (campo.value.length == conjunto1)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto2)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto3)
                    campo.value = campo.value + separacao2;
                else if (campo.value.length == conjunto4)
                    campo.value = campo.value + separacao3;
                else if (campo.value.length == conjunto5)
                    campo.value = campo.value + separacao3;
            } else {
                event.returnValue = false;
            }

        }
    </script>

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');
</style>

<body>

    <!-- CALENDÁRIO-->
    <br />

    <div class="container">
        <div align="center" style="margin-top:80px;">
            <div class="title-back">
                <h1 class="title ">
                    Agenda
                </h1>
            </div>
        </div>
        <br />

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <div id="calendar" style="background:white;padding:10px;border-radius:15px;margin-bottom:100px;"></div>
    </div>

    <style>
        .visualizar {
            display: block;
        }

        .form {
            display: none;
        }
    </style>

    <!-- POPUP VER ATIVIDADE -->
    <div class="modal fade" id="verAtividade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:27px; font-family: 'Chewy'; color: #03036B;">Detalhes da Atividade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="visualizar">
                        <div class="dl-horizontal">

                            <dt> Atividade: &nbsp; </dt>
                            <dd id="title"></dd>
                            <br>
                            <dt> Amigo: &nbsp; </dt>
                            <dd id="amigo"></dd>
                            <br>
                            <dt> Data de início: &nbsp; </dt>
                            <dd id="start"></dd>
                            <br>
                            <dt> Data de fim: &nbsp; </dt>
                            <dd id="end"></dd>
                            <br>
                            <dt> Descrição: &nbsp; </dt>
                            <dd id="desc"></dd>
                            <br>
                        </div>

                        <div class="btn-group">
                            <button class="btn btn-canc-vis btn-warning mr-1">Editar</button>

                            <form id="eliminarAtividade" method="POST" action="delete_activities.php">
                                <input type="hidden" name="id" id="id">
                                <button type="submit" name="submit" id="submit" form="eliminarAtividade" class="btn btn-canc-vis btn-danger">Eliminar atividade</button>
                            </form>
                        </div>

                    </div>

                    <div class="form">
                        <form id="editarAtividade" method="POST" action="update_activities.php">
                            <div class="form-row">
                                <div class="form-group col-sm-10">

                                    <?php
                                    $query = "SELECT ID_CATEGORIA, CATEGORIA FROM categoria;";
                                    $result = mysqli_query($mysqli, $query);

                                    while ($found = mysqli_fetch_assoc($result)) {
                                        $categorias[] = $found;
                                    }

                                    ?>

                                    <label>Tipo de Atividade:</label>

                                    <select name="categoria" id="title2" class="form-control">
                                        <?php foreach ($categorias as $categoria) : ?>
                                            <option value="<?php echo $categoria['ID_CATEGORIA'] ?>">
                                                <?php echo $categoria['CATEGORIA'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="form-group col-sm-10">
                                    <label>Data de início:</label>
                                    <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
                                </div>

                                <div class="form-group col-sm-10">
                                    <label>Data de fim:</label>
                                    <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
                                </div>

                                <div class="form-group col-sm-10">
                                    <label>Descrição:</label>
                                    <textarea class="form-control" type="text" rows="4" placeholder="Notas" id="desc"></textarea>
                                </div>

                            </div>

                            <input type="hidden" class="form-control" name="id" id="id">

                            <div class="form-group col-sm-10">
                                <button type="submit" name="submit" id="submit" form="editarAtividade" class="btn btn-warning">Guardar alterações</button>
                                <button type="button" class="btn btn-canc-edit btn-danger">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- POPUP ADICIONAR ATIVIDADE -->
    <div class="modal fade" id="inserirAtividade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" style="font-size:27px; font-family: 'Chewy'; color: #03036B;">Adiciona uma atividade!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="novaAtividade" method="POST" action="insert_activities.php">
                        <div class="form-row">
                            <div class="form-group col-sm-10">

                                <label>Tipo de Atividade:</label>

                                <select name="categoria" class="form-control">
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <option value="<?php echo $categoria['ID_CATEGORIA'] ?>">
                                            <?php echo $categoria['CATEGORIA'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <?php

                            $query = "SELECT u.nome, m.id
                                    FROM (SELECT id_user1 as id
                                        FROM matches WHERE id_user2=$session_id
                                        UNION SELECT id_user2 as id
                                        FROM matches WHERE id_user1=$session_id) as m,
                                        utilizadores as u
                                    WHERE m.id = u.user_id;";

                            $result = mysqli_query($mysqli, $query);

                            while ($found = mysqli_fetch_assoc($result)) {
                                $amigos[] = $found;
                            }

                            ?>

                            <div class="form-group col-sm-10">

                                <label>Amigo:</label>

                                <select name="amigo" id="amigo" class="form-control">
                                    <?php foreach ($amigos as $amigo) : ?>
                                        <option value="<?php echo $amigo['id'] ?>">
                                            <?php echo $amigo['nome'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-sm-10">
                                <label>Data de início:</label>
                                <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
                            </div>

                            <div class="form-group col-sm-10">
                                <label>Data de fim:</label>
                                <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
                            </div>

                            <div class="form-group col-sm-10">
                                <label>Descrição:</label>
                                <textarea class="form-control" type="text" rows="4" placeholder="Notas" id="desc" name="desc"></textarea>
                            </div>

                        </div>

                        <button id="submit" name="submit" type="submit" form="novaAtividade" class="btn btn-success">Guardar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('.btn-canc-vis').on("click", function() {
            $('.form').slideToggle();
            $('.visualizar').slideToggle();
        });

        $('.btn-canc-edit').on("click", function() {
            $('.visualizar').slideToggle();
            $('.form').slideToggle();
        });
    </script>

</body>

</html>