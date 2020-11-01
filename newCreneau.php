<?php
$data;
session_start();
include('db.php');
getAllSalle($data);
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<h2 class="text-center" style="margin-top:70px">Nouveau créneau </h2>
<div class="d-flex p-2 bd-highlight" style="height:75%">
<?php
		include("header.php");
     ?>
     <div class="align-self-center mx-auto"> 
         <div  class="jumbotron" style="opacity:0.8">
    <form action="addCreneau.php?jeton=<?=$_SESSION['jeton']?>&place=<?=$_GET['place']?>" method="post" >
    
    <div class="form-group">
        <label for="salle">Salle:</label>
        <select id="salle" class="form-control"  name="salle">
            <option value=" " color="silver">--Please choose an option--</option>
                <?php
                foreach ($data as $value) {
              
                ?>
               
                <option  value="<?=$value['Num_S']?>"><?=$value['Num_S']?></option>
                <?php
                }
                ?>
            </select>
        </div>
            
            <div class="form-group">
                <label for="date"> Date:</label>
                <input type="date" id="date" name="date" value="2020-01-01" min="2020-01-01" max="2020-12-31" class="form-control">
                </div>
              <div class=form-group>
              <label for="start"> Heure Début:</label>
                <input type="time" id="start" step="1" name="DateD"  min="2020-01-01" max="2020-12-31" class="form-control">
              </div>
                <div class="form-group">
                <label for="end"> Heure Fin:</label>
                <input type="time" id="start" step="1" name="DateF"  min="2020-01-01" max="2020-12-31" class="form-control">
                </div>
                
                <div class=" soumettre">
                <input type="submit" class="btn btn-primary" value="Ajouter">
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