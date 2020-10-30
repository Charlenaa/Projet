<?php
$id=$_POST['id'];
$message=$_POST['message'];
$date=$_POST['date'];
$idc=$_POST['idc'];
session_start();
include('db.php');
insertReponse($id,$message,$date,$idc);
echo 'reuissi';