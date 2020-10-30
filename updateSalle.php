<?php
include ('db.php');
$nb=$_POST['nb'];
$nums=$_POST['nums'];
updateSalle($nums,$nb);
$data;
getOneSalleAll($data,$nums);
echo json_encode($data);
