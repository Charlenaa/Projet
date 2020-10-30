<?php
session_start();
$code=array($_POST['code0'],$_POST['code1'],
$_POST['code2'],$_POST['code3'],
$_POST['code4'],$_POST['code5']);
$pseudo=$_POST['pseudo'];
include('db.php');
$page=connectByCode($pseudo,$code);
$data=array('page'=>$page, 'pseudo'=>$pseudo);
echo json_encode($data);