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
     
  <div class="d-flex p-2 bd-highlight" style="height:100%">
  <div class="align-self-center mx-auto">
  <div >

    <div class="row justify-content-start custom-line m-4">
    <div class="col-5 m-2" data-toggle="tooltip" tabindex="0" title="Réservation">
    <a href="reservation.php?jeton=<?=$_SESSION['jeton']?>"> <img src="Réservation.jpg"  id="Plan" width="500" height="500" class="img-fluid rounded mx-auto d-block" style="height:100%" > </a>     
    </div>
     
    <div class="col-5 m-2" data-toggle="tooltip" tabindex="0" title="Liste des salles">
    <a href="salles.php?jeton=<?=$_SESSION['jeton']?>"> <img src="interieur.jpg" width="500" height="500" id="Plan" class=" img-fluid rounded mx-auto d-block" style="height:100%"/> </a>
     </div> 
      </div> 
      
      <div class="row justify-content-start custom-line m-4">
    <div class="col-5 m-2">
    <a href="faq.php"> <img src="faq.jpg" width="500" height="500" id="Plan"  class="rounded img-fluid mx-auto d-block" style="height:100%"/> </a>
    </div> 

      <div class="col-5 m-2">
      <a href="salles.php"> <img src="information.jpg" width="500" height="500" id="Plan" class="rounded img-fluid mx-auto d-block" style="height:100% ;max-width:100%" /> </a>
      </div> 
      </div> 
      </div>
</div>
</div>
<?php
include 'footer.php';
?>
</body>
</html>
<?php
}
else{
    header('location:index.php');
}
?>