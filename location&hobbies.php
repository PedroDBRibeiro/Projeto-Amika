<?php
include "config.php";

if (isset($_POST['localização']))
        {
        $localização = $_POST['localização'];
        echo $localização;
    } 
    else 
        {
        $localização = null;
    }

if (isset($_POST["hobbies"]))
    {
    $hobbies = $_POST['hobbies'];
      //print_r ($hobbies);
      
  $sql="select * from hobbies";
 
  $result= mysqli_query($mysqli,$sql);
 
  //$rows = mysqli_num_rows($result);

  while($row = mysqli_fetch_array($result)){
    echo $row['id_utilizador']; echo " " ; 

    foreach($hobbies as $hobbie){

      if($hobbie == $row['hobbie']){
      echo $row['hobbie']; echo " ";  
    }
      if($hobbie == $row['hobbie2']){
      echo $row['hobbie2']; echo " ";
    }
      if($hobbie == $row['hobbie3']){
      echo $row['hobbie3']; echo " ";
    }
    if($hobbie == $row['hobbie4']){
      echo $row['hobbie4']; echo " ";
    }
    if($hobbie == $row['hobbie5']){
      echo $row['hobbie5']; echo " ";
    }
    if($hobbie == $row['hobbie6']){
      echo $row['hobbie6']; echo " ";
    }
    if($hobbie == $row['hobbie7']){
      echo $row['hobbie7']; echo " ";
    }
    if($hobbie == $row['hobbie8']){
      echo $row['hobbie8']; echo " ";
    }
    if($hobbie == $row['hobbie9']){
      echo $row['hobbie9']; echo " ";
    }
    if($hobbie == $row['hobbie10']){
      echo $row['hobbie10']; echo " ";  
    }
    if($hobbie == $row['hobbie11']){
      echo $row['hobbie11']; echo " ";  
    }

    }
    echo "<br>";
  }

} 
else 
    {
      $hobbies = null;
    }

?>