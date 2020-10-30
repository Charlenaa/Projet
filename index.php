<?php
session_start();
$_SESSION['user']=array('droits'=>'aucun');
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
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body  style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<div class="d-flex p-2 bd-highlight" style="height:85%">
<?php
		include("header.php");
     ?>
     <div class="align-self-center mx-auto">
     <div class="jumbotron" style="opacity:0.8">
        <form action="connexion.php" method="post">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo">
        </div>
        <div class="form-group">
            <label for="pass">Pass :</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Connexion</button>
        </div>
        </form>
        <div><a href="pseudo.php?">Connectez avec votre code d'identification pour une meilleure sécurité</a></div>
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