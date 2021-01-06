<?php

//PÁGINA PRINCIPAL DO CHAT

include('database_connection.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    header("location:../Homepage.php");
}

?>

<html>

<head>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/Amik@.css">


</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');
</style>

 
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="font-family: 'Chewy';">
<a class="navbar-brand" href="../Homepage.php">
<img src="../Imagens\Logo.png" alt="Logo Amik@"  width="170" height="80"></img>
</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <?php 
        if(isset($_SESSION['loggedin'])){
                ?> 
        <a  class="nav-link" href="../profile.php?search_result=<?php echo $_SESSION['user_id']; ?>" style="text-decoration:none;padding-left:50px;"> 
        <img src="../imagens\profile.png" alt="Profile Icon" width="50" height="50" ></img>
        PERFIL
        </a>

        <?php } ?>
      </li>
      
  
      <li class="nav-item ">
                    <?php 
                            if(isset($_SESSION['loggedin'])){
                        ?> 
                                    <a  class="nav-link" href="../logout.php" style="text-decoration:none;padding-right:50px;">
                                      <img src="../imagens\Logout.png" alt="Logout Icon" width="50" height="50" ></img>
                                        SAIR
                                    </a>
                        <?php }

                        else{ ?> 
                        <a   class="nav-link" data-toggle="modal" data-target="#myModal"  style="width:auto;" style="text-decoration:none;">
                            <img src="../imagens\login.png" alt="Login Icon" width="30" height="30" class="d-inline-block align-top"></img>
                            Entrar
                        </a>
                        <?php 
                            } 
                        ?>  
      </li>
    </ul>
  </div>
</nav>


<body style="padding-top:100px;">

<div>
    <div class="container" >
        <div align ="center" style="margin-top:80px;">
            <div class="title-back" >
                <h1 class="title ">
                    Chat
                </h1>
            </div>
        </div>
        <br/>
        <div class="table-responsive"><br>
            <h3   align="center" style="font-family: 'Chewy';" ><?php  echo 'Olá '.$_SESSION['nome'].'!'; ?> Aqui poderás falar com as pessoas com quem fizeste amizade!</h3><br>
            <div id="user_details"  ></div>
            <div id="user_model_details" style="padding-top:200px;"></div>
        </div>
    </div>
</div>
</body>

</html>



<!-- JavaScript -->
<script>
    $(document).ready(function() {

        fetch_user();

        setInterval(function() {
            update_last_activity();
            fetch_user();
            update_chat_history_data();
        }, 5000);

        function fetch_user() {
            $.ajax({
                url: "fetch_user.php",
                method: "POST",
                success: function(data) {
                    $('#user_details').html(data);
                }
            })
        }

        function update_last_activity() {
            $.ajax({
                url: "update_last_activity.php",
                success: function() {

                }
            })
        }

        function make_chat_dialog_box(to_user_id, to_user_name) {
            var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="Estás a falar com ' + to_user_name + '">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
            modal_content += fetch_user_chat_history(to_user_id);
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control chat_message"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-info send_chat">Enviar</button></div></div>';
            $('#user_model_details').html(modal_content);
        }

        $(document).on('click', '.start_chat', function() {
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tonome');
            make_chat_dialog_box(to_user_id, to_user_name);
            $("#user_dialog_" + to_user_id).dialog({
                autoOpen: false,
                width: 400
            });
            $('#user_dialog_' + to_user_id).dialog('open');
        });

        $(document).on('click', '.send_chat', function() {
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_' + to_user_id).val();
            $.ajax({
                url: "insert_chat.php",
                method: "POST",
                data: {
                    to_user_id: to_user_id,
                    chat_message: chat_message
                },
                success: function(data) {
                    $('#chat_message_' + to_user_id).val('');
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        });

        function fetch_user_chat_history(to_user_id) {
            $.ajax({
                url: "fetch_user_chat_history.php",
                method: "POST",
                data: {
                    to_user_id: to_user_id
                },
                success: function(data) {
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        }

        function update_chat_history_data() {
            $('.chat_history').each(function() {
                var to_user_id = $(this).data('touserid');
                fetch_user_chat_history(to_user_id);
            });
        }

        $(document).on('click', '.ui-button-icon', function() {
            $('.user_dialog').dialog('destroy').remove();
        });

        $(document).on('focus', '.chat_message', function() {
            var is_type = 'yes';
            $.ajax({
                url: "update_is_type_status.php",
                method: "POST",
                data: {
                    is_type: is_type
                },
                success: function() {

                }
            })
        });

        $(document).on('blur', '.chat_message', function() {
            var is_type = 'no';
            $.ajax({
                url: "update_is_type_status.php",
                method: "POST",
                data: {
                    is_type: is_type
                },
                success: function() {

                }
            })
        });

    });
</script>