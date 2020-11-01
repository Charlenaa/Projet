<?php
session_start();
if($_GET['jeton']==$_SESSION['jeton'] && $_SESSION['jeton']=!''){
$num=$_POST['num'];
include('db.php');
supprimerCreneau($num);
echo $num;
}
else{
    echo "erreur";
}