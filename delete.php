<?php
include 'db.php';
$numc=$_POST['numc'];
$nums=$_POST['nums'];
$dateR=$_POST['dateR'];
$id=$_POST['id'];
$ligne=$_POST['ligne'];
deleteEtudiant($dateR,$id,$nums,$numc);
echo $ligne;
