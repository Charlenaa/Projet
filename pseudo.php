<?php
session_start();
//if($_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
//var_dump($_SESSION['jeton']);
?>
<!DOCTYPE html>
<html lang="en" style="height:100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Pseudo</title>
</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover " >
<div class="d-flex p-2 bd-highlight" style="height:75%">
<?php
		include("header.php");
     ?>    
<div class="align-self-center mx-auto">
    <div class="card" style="width: 24rem; opacity:0.8">
  <div class="card-body">
    <h5 class="card-title text-center">Connexion</h5>
    <form action="">
        <div class="form-group">
            <label for="pseudo">pseudo: </label>
            <input type="text" class="form-control" name="pseudo" id="pseudo">
        </div>
    </form>
    <a href="#" id="sub" class="btn btn-primary">suivant</a>
  </div>
</div> 
    </div>
</div>
<?php
include 'footer.php';
?>
   <script>
       let sub=document.getElementById('sub');
       sub.onclick=function(e){
           e.preventDefault();
           redirect();
       }
       function redirect(){
           let pseudo=document.getElementsByName('pseudo');
           document.location.href="codeSecret.php?pseudo="+pseudo[0].value;
       }
       let footer=document.getElementsByTagName('footer')[0];
    footer.classList.add('fixed-bottom');
   </script>
</body>
</html>
<?php

?>