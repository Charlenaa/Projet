<?php
session_start();
include("db.php");
$DD=$_POST['DD'];
$DF=$_POST['DF'];
$num_S=$_POST['idS'];
$num_c=$_POST['id_C'];
if($_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
modifier($num_c,$DD,$DF,$num_S);
}
header('location:salleA.php?id='.$num_S.'&place='.$_POST['nb_place'].'&jeton='.$_SESSION['jeton']);