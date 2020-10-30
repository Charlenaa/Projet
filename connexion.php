<?php
session_start();
$pseudo=$_POST['pseudo'];
$pass=$_POST['pass'];
include('db.php');
connexion($pseudo,$pass);
