<?php
session_start();
$salle =$_POST["salle"];
$DateD =$_POST ["DateD"];
$DateF =$_POST ["DateF"];
$date=$_POST['date'];
include ('db.php');
if($_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
Creneau($DateD,$DateF,$salle,$date);
}
header('location:salleA.php?id='.$salle.'&place='.$_GET['place'].'&jeton='.$_SESSION['jeton']);