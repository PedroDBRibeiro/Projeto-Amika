
<?php

include('database_connection.php');

session_start();

if(!isset($_SESSION['user_id']))
{
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
    
    <header>

<table class="tabelaHeader" >

    <tr>
        <th >

    <?php 
       if(isset($_SESSION['loggedin'])){
?> 
            <a  href="../Profile.php" style="text-decoration:none;"> 
                <img src="../imagens\profile.png" alt="Profile Icon" class="IconHeader"></img>
                <p class="hyperlink">PERFIL</p> 
            </a>
            
            <?php }
        else{ ?>
       
       
    <?php 
        }       
        ?>

        </th>

        <th>
            <a href="../Homepage.php">
            <img src="../Imagens\LogoAmika.png" alt="Logo Amik@" class="logoAmika"></img>
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
                        <a  href="../logout.php" style="text-decoration:none;">
                            <img src="../imagens\Logout.png" alt="Logout Icon" class="IconHeader"></img>
                            <p class="hyperlink">SAIR</p> 
                        </a>
            <?php }

            else{ ?> <!-- data-toggle="modal" data-target="#myModal"-->
            <a   data-toggle="modal" data-target="#myModal"  style="width:auto;" style="text-decoration:none;">
                <img src="../imagens\login.png" alt="Login Icon" class="IconHeader"></img>
                <p class="hyperlink">ENTRAR</p> 
            </a>
            <?php 
                } 
            ?>                      
        </th>

    </tr>

</table>

</header>

    <body>  
        <div class="container">
   <br />

   <div style="background: linear-gradient(#ffff00,#ffd769); width: 25%; margin-top:50px; border-radius: 25px; padding: 5px;" class="center" >
            <h1 style="font-family: 'Chewy'; text-align: center; color: #03036B; font-size: 48px; ">
                Chat
            </h1>
        </div>
   <br />
   
   <div class="table-responsive"><br>
     <h3 align="center">Utilizadores</h3>
    <p align="right">Olá - <?php echo $_SESSION['nome'];  ?> !  </p>
    <div id="user_details"></div>
    <div id="user_model_details"></div>
   </div>
  </div>
    </body>  
</html>  




<script>  
$(document).ready(function(){

 fetch_user();

 setInterval(function(){
  update_last_activity();
  fetch_user();
  update_chat_history_data();
 }, 5000);

 function fetch_user()
 {
  $.ajax({
   url:"fetch_user.php",
   method:"POST",
   success:function(data){
    $('#user_details').html(data);
   }
  })
 }

 function update_last_activity()
 {
  $.ajax({
   url:"update_last_activity.php",
   success:function()
   {

   }
  })
 }

 function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Estás a falar com '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += fetch_user_chat_history(to_user_id);
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Enviar</button></div></div>';
  $('#user_model_details').html(modal_content);
 }

 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tonome');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');
 });

 $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var chat_message = $('#chat_message_'+to_user_id).val();
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message},
   success:function(data)
   {
    $('#chat_message_'+to_user_id).val('');
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 });

 function fetch_user_chat_history(to_user_id)
 {
  $.ajax({
   url:"fetch_user_chat_history.php",
   method:"POST",
   data:{to_user_id:to_user_id},
   success:function(data){
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 }

 function update_chat_history_data()
 {
  $('.chat_history').each(function(){
   var to_user_id = $(this).data('touserid');
   fetch_user_chat_history(to_user_id);
  });
 }

 $(document).on('click', '.ui-button-icon', function(){
  $('.user_dialog').dialog('destroy').remove();
 });

 $(document).on('focus', '.chat_message', function(){
  var is_type = 'yes';
  $.ajax({
   url:"update_is_type_status.php",
   method:"POST",
   data:{is_type:is_type},
   success:function()
   {

   }
  })
 });

 $(document).on('blur', '.chat_message', function(){
  var is_type = 'no';
  $.ajax({
   url:"update_is_type_status.php",
   method:"POST",
   data:{is_type:is_type},
   success:function()
   {
    
   }
  })
 });
 
});  
</script>