<?php

include "config.php";

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale-all.js" integrity="sha512-AwJjAPOy0uMTn1lRSSbEWp3uu4r+Eq/Y2Prp/JlKhvRel2Ssx3YsnjiGH/FTtalIJo+acpp73cexg3Jn15cnJw==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
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


                //Utilizador carrega num dia do calendário
                //Abre um popup para introduzir os detalhes da atividade
                select: function(start, end, allDay) {

                    var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD");
                    var end = $.fullCalendar.formatDate(end, "YYYY-MM-DD");


                    $('#popup').modal('show');

                    $("#submitButton").on("click", function(e) {

                        e.preventDefault();

                        var title = $("#categoria").val();

                        var starttime = $("#datainicio").val();
                        start = moment(start + "T" + starttime).format('YYYY-MM-DD HH:mm:ss');

                        var endtime = $("#datafim").val();
                        end = moment(end + "T" + endtime).format('YYYY-MM-DD HH:mm:ss');

                        //var startdate = start + "T" + starttime + ":00";
                        //var enddate = end + "T" + endtime + ":00";

                        $.ajax({
                            url: "insert_activities.php",
                            type: "GET",
                            data: {
                                title: title,
                                start: start,
                                end: end
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("A atividade foi introduzida no calendário!");
                            }
                        })

                        $("#popup").modal("hide");
                    });


                },

                editable: true,
                navLinks: true,
                eventLimit: true,


                //Utilizador faz resize da atividade
                //Atualiza na BD a data inicio e fim da atividade
                eventResize: function(event) {
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
                },

                eventClick: function(event) {
                    if (confirm("Tem a certeza que quer apagar a atividade?")) {
                        var id = event.id;
                        $.ajax({
                            url: "delete_activities.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("A atividade foi removida!");
                            }
                        })
                    }
                },

            });


            $(function() {
                $('#datetimepicker1').datetimepicker({
                    format: 'HH:mm',
                    locale: 'pt'
                });

                $('#datetimepicker2').datetimepicker({
                    format: 'HH:mm',
                    locale: 'pt'
                });
            });


        });
    </script>
</head>

<body>
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
                    <a href="Homepage.php" style="text-decoration:none;">
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

    <!-- POPUP -->
    <div id="popup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">close</span></button>
                    <h4>Adiciona uma atividade!</h4>
                </div>
                <div id="modalBody" class="modal-body">
                    <label class="control-label">Tipo de atividade:</label>
                    <?php
                    $query = "SELECT DISTINCT CATEGORIA FROM categoria;";
                    $result = mysqli_query($mysqli, $query);

                    while ($found = mysqli_fetch_assoc($result)) {
                        $categorias[] = $found;
                    }

                    ?>
                    <div class="form-group">
                        <select id="categoria" class="browser-default custom-select">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?php echo $categoria['CATEGORIA'] ?>">
                                    <?php echo $categoria['CATEGORIA'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <label class="control-label">Começa às:</label>
                    <div class="form-group form-inline">

                        <div class="input-group date" id="datetimepicker1">
                            <input id="datainicio" class="form-control" type="text"></input>
                            <span class="input-group-addon">
                                <i class="fas fa-clock"></i>
                            </span>
                        </div>
                    </div>

                    <label class="control-label">Acaba às:</label>
                    <div class="form-group form-inline">

                        <div class="input-group date" id="datetimepicker2">
                            <input id="datafim" class="form-control" type="text"></input>
                            <span class="input-group-addon">
                                <i class="fas fa-clock"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" type="text" rows="4" placeholder="Notas" id="eventDescription"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                </div>
            </div>
        </div>
    </div>

    <br />
    <h2 align="center"><a href="#">Agenda</a></h2>
    <br />
    <div class="container">
        <div id="calendar"></div>
    </div>
</body>

</html>