<?php


include "config.php";

$categoria = $_GET["title"];
$datainicio = $_GET["start"];
$datafim = $_GET["end"];

echo $datainicio;
echo $datafim;

$get_id_categoria = "SELECT ID_CATEGORIA FROM CATEGORIA WHERE CATEGORIA = '$categoria'";


$idcat1 = mysqli_query($mysqli, $get_id_categoria);
$idcat2 = mysqli_fetch_assoc($idcat1);
$idcat = $idcat2['ID_CATEGORIA'];


$query = "INSERT INTO atividades
        (ID_CATEGORIA, DATA_INICIO, DATA_FIM)
        VALUES ('$idcat', '$datainicio', '$datafim');" ;


mysqli_query($mysqli, $query);


//}
