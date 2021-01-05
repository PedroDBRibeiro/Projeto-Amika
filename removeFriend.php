<?php

include "config.php";

$user = $_SESSION['user_id'];

if(isset($_POST['removeFriend'])){


$remove ="DELETE FROM matches where (id_user1 = '$user_id' and id_user2 = '$user') 
or (id_user2 = '$user_id' and id_user1 = '$user')";

$result = mysqli_query($mysqli,$remove) or die(mysqli_error($mysqli));

}


?>