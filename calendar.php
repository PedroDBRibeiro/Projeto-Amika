<?php
//index.php

?>

<!DOCTYPE html>
<html>

<head>
    <title>Agenda</title> 
    <link rel="stylesheet" type="text/css" href="CSS/Amik@.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale-all.js" integrity="sha512-AwJjAPOy0uMTn1lRSSbEWp3uu4r+Eq/Y2Prp/JlKhvRel2Ssx3YsnjiGH/FTtalIJo+acpp73cexg3Jn15cnJw==" crossorigin="anonymous"></script>
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
                events: 'load_activities.php',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    
                    var title = prompt("Enter Event Title");
                    
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                        //var start = "2020-11-28 00:00:00";
                        var end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");

                        //var start=moment(start).format('YYYY-MM-DDTHH:mm:ssZ');
                        //var end=moment(end).format('YYYY-MM-DDTHH:mm:ssZ');

                        $.ajax({
                            url: "insert_activities.php",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        })
                    }
                    
                },
                editable: true,
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
                            alert('Event Update');
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
                            alert("Event Updated");
                        }
                    });
                },

                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "delete_activities.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Removed");
                            }
                        })
                    }
                },

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

    <br/>
    <h2 align="center"><a href="#">Agenda</a></h2>
    <br/>
    <div class="container">
        <div id="calendar"></div>
    </div>
</body>

</html>