<?php
include('db.php');
$nums=$_POST['nums'];
$numc=$_POST['numc'];
$date=$_POST['dateR'];
$id=$_POST['id'];
annuler($nums,$numc,$date,$id);
$resp=array('nums'=>$nums,'numc'=>$numc,'date'=>$date,'id'=>$id);
echo json_encode($resp);