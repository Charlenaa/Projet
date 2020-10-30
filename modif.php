<?php
include("db.php");
$DD=$_POST['DD'];
$DF=$_POST['DF'];
$num_S=$_POST['idS'];
$num_c=$_POST['id_C'];

modifier($num_c,$DD,$DF,$num_S);
var_dump($num_S);
?>