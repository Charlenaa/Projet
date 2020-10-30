<?php
session_start();
include('db.php');
$data;
$user=$_SESSION['user'];
reservation($data,$user['id']);
if($user['droits']=='admin'){
    header('location:sallesA.php?jeton='.$_SESSION['jeton']);
    exit(0);
}
if($user['droits']=='etudiant' &&  $_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes reservations</title>
</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<?php
		include("header.php");
     ?>
    <div id="app" class="container" style="margin-top:70px">
    <h1 class="text-center">Mes reservations</h1>
    <table class="table table-hover table-bordered table-secondary">
        <tr>
            <th>Créneau(x)</th>
            <th>Salle Reservée(s)</th>
            <th>Date</th>
            <th>Début</th>
            <th>Fin</th>
            <th></th>
        </tr>
        <?php
        foreach ($data as $value) {
         
    ?>
    <tr id="<?=$value['salle']?>_<?=$value['creneau']?>_<?=$user['id']?>_<?=$value['dateR']?>">
    <td ><?=$value['creneau']?></td>
    <td><?=$value['salle']?></td>
    <td><?=$value['dateR']?></td>
    <td><?=$value['debut']?></td>
    <td><?=$value['fin']?></td>

    <td><button class="btn btn-danger" 
    onclick="annuler(<?=$value['salle']?>,
    <?=$value['creneau']?>,
    <?=$user['id']?>,
    `<?=$value['dateR']?>`
    )">Annuler</button></td>
    </tr>
    
    <?php
 }?>
    </table>
    </div>
    <?php
include 'footer.php';
?>
    
<script>
     if(<?=count($data)?><=6){
    let footer=document.getElementsByTagName('footer')[0];
    footer.classList.add('fixed-bottom');
    }
    function annuler(nums,numc,id,dateR){
        if(confirm("Voulez vous vraiment annulez votre réservation ?")){
        var data= new FormData();
        data.set('nums',nums);
        data.set('numc',numc);
        data.set('id',id);
        data.set('dateR',dateR);
        console.log(dateR);
        axios({
            method:'post',
            url:'annuler.php',
            data:data
        }).then((response)=>{
            console.log(response.data);
            let res=document.getElementById(response.data.nums+'_'+
            response.data.numc+'_'+response.data.id+'_'+response.data.date);
            let tab=res.parentElement;
            console.log(res);
            tab.removeChild(res);
        })
    }
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