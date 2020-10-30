<?php

$salle =$_POST["salle"];
$DateD =$_POST ["DateD"];
$DateF =$_POST ["DateF"];
$date=$_POST['date'];
include ('db.php');
Creneau($DateD,$DateF,$salle,$date);

