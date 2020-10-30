<?php
session_start();
include('db.php');
$data;
getSalle($data);
$user=$_SESSION['user'];
if($user['droits']=='admin' && $_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
    if(time()>=$_SESSION['ttl']){
        echo "sup";
        $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
        $_SESSION['ttl']=time()+10*60;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des salles</title>
</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<?php
		include("header.php");
     ?>
    <div class="container" style="margin-top:70px">
    <h1 class="text-center">Liste des salles disponibles</h1>
    <table class="table table-hover table-bordered table-secondary">
        <tr>
            <th>Numero de salle</th>
            <th>Nombre de places</th>
            <th>nombre de créneaux disponibles</th>
        </tr>
        <?php
        foreach ($data as $value) {
         
    ?>
    <tr onclick="getSalle(<?=$value['Num_S']?>,<?=$value['Nbre_Place']?>,`<?=$_SESSION['jeton']?>`)">
    <td > <?=$value['Num_S']?></td>
    <td><?=$value['Nbre_Place']?></td>
    <td><?=$value['nb_creneau']?></td>
    </tr>
    
    <?php
 }?>
    </table>
    </div>
    <?php
include 'footer.php';
?>
    
<script>
    function getSalle(val,place,jeton){
        console.log(jeton);

        document.location.href="salleA.php?id="+val+"&place="+place+"&jeton="+jeton;
    }

</script>
</body>
</html>
<?php
}
else{
    header('Location:index.php');
}
?>
