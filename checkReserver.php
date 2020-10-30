<?php
include('db.php');
$num=$_POST['numS'];
$date=$_POST['dateR'];
$data;
getOneCreneau($data,$num,$date);

echo json_encode($data);