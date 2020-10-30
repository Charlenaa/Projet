<?php
$id=$_POST['id'];
$message=$_POST['message'];
$date=$_POST['date'];
session_start();
include('db.php');
insertCommentaire($id,$message,$date);
echo 'reuissi';