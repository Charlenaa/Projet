<?php
session_start();
$user=$_SESSION['user'];
if(($user['droits']=='etudiant' || $user['droits']=='admin') ){
    if(time()>=$_SESSION['ttl']){
        $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
        $_SESSION['ttl']=time()+10*60;
    }
?>
<!DOCTYPE html>
<html lang="en" style="height:100%">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BIENVENUE @... </title>
    <style>  
   
 .row div img {
	    -webkit-transform: scale(1);
	  transform: scale(1);
	  -webkit-transition: .3s ease-in-out;
	  transition: .3s ease-in-out;
    }
    .row div:hover img {
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
    }
    </style>

</head>

<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<?php
		include("header.php");
     ?>
     
  <h1 class="text-center" style="margin-top:60px">Informations</h1>
  <div class="container text-white">
  <div class="row">
      <div class="col-md m-2 text-break">
Le site de réservation permet de respecter les règles de distanciations afin d'éviter la propagation
du COVID 19 <br>
Prenant conscience de la situation actuelle, nous voulons préserver la détermination des étudiants
en leur permettant d'accéder à des salles en toute sécurité. Ainsi nous leur permettons d'occuper des
salles en respectant des conditions pour garantir leur sécurité.
<p>
    La mise sur pied d'un tel système met en évidence notre détermination et notre contribution pour
    la sortie de cette situation de crise causée par le COVID.
</p>
      </div>
      <div class="col-md m-2 text-break">
Il est très important pour nous en tant qu'étudiant ingénieur de prévoir divers scénarios.
Notre travail consiste ainsi à penser aux problèmes potentiels et à réfléchir à des solutions pour y rémédier.
<p>
Le travail en équipe nous permet de dévolopper non seulement nos sens de l'organisation mais surtout d'apprendre 
des autres en comptant sur eux pour le soutien moral et technique que chacun constitue.
</p>
<p>Nous avons pu mener ce projet au terme grâce à l'engagement et la détermination des membres de l'équipe.
    <br> Nous remercions notre enseignant qui nous a guidé lors de la réalisation de ce projet.
</p>
      </div>
  </div>
  </div>
  
<?php
include 'footer.php';
?>
<script>
    let footer=document.getElementsByTagName('footer')[0];
    footer.classList.add('fixed-bottom');

</script>
</body>
</html>
<?php
}
else{
    header('location:index.php');
}
?>