<?php
session_start();
include ('db.php');
$nb=$_POST['nb'];
$nums=$_POST['nums'];
if($_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
updateSalle($nums,$nb);
$data;
getOneSalleAll($data,$nums);
echo json_encode($data);
}