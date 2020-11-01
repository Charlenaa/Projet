<?php
session_start();
$user=$_SESSION['user'];
if($user['droits']=='etudiant' || $user['droits']=='admin' && $_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
    if(time()>=$_SESSION['ttl']){
        echo "sup";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<h2 class="text-center" style="margin-top:70px">Modifier créneau </h2>
    <div class="d-flex p-2 bd-highlight" style="height:75%">
<?php
		include("header.php");
     ?>
     <div class="align-self-center mx-auto"> 
         <div  class="jumbotron" style="opacity:0.8">
         <form method="post" action="modif.php?jeton=<?=$_SESSION['jeton']?>">
         
         <div class="form-group">
            <label for="nb">Id créneau :</label>
            <input type="text" class="form-control"  value="<?=$_GET['numC']?>" disabled>
        </div>
        <input type="hidden" name="id_C" value ="<?=$_GET['numC']?>">
        <input type="hidden" name="idS" value ="<?=$_GET['numS']?>">
        <div class="form-group">
            <label for="nb">Nombre de places</label>
            <input type="text" class="form-control" name="nb_place" value="<?=$_GET['nb']?>" disabled>
        </div>
        <div class="form-group">
            <label for="date">Date début :</label>
            <input type="time" step="1" class="form-control" value= "<?=$_GET['datD']?>" id="date" name="DD" placeholder="Entrez la date de début">
        </div>
        <div>
            <label for="date">Date fin :</label>
            <input type="time" class="form-control" step="1" value= "<?=$_GET['datF']?>" id="Nb" name="DF" placeholder="Entrez la date de fin">
        </div>
        <div class="m-2">
            <button type=submit class="btn btn-primary">Confirmer</button>
        </div>
        
        </form>
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