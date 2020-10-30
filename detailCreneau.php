<?php
include('db.php');
$data;
 $num=$_GET['num'];
 $numS=$_GET['numS'];
ListeEtudiant($data,$num,$numS);

?>


<?php
session_start();
$user=$_SESSION['user'];
if($user['droits']=='admin'){



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details </title>
</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover">
<?php
		include("header.php");
     ?>  
<div id="app" class="container" style="margin-top:45px">
    <h1 class="text-center">Details créneau <button class="btn" onclick="document.location.href='modifierC.php?jeton=<?=$_SESSION['jeton']?>&numC=<?=$_GET['num']?>&numS=<?=$_GET['numS']?>&datD=<?=$_GET['datD']?>&datF=<?=$_GET['datF']?>&nb=<?=$_GET['nb']?>'"><i class="material-icons">&#xe150;</i></button></h1>
    <div class="row mb-5 ">
        <div class="col">
           <input type="text" class="form-control" value="Date: <?=$_GET['date']?>" disabled>
        </div>
        <div class="col">
            <input type="text" disabled class="form-control" value="Debut: <?=$_GET['datD']?>">
        </div>
        <div class="col">
            <input type="text" disabled class="form-control" value="Fin: <?=$_GET['datF']?>">
        </div>
    </div>
    <table class="table table-bordered table-secondary">
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Mail</th>
        <th>Classe</th>
        <th></th>
    <?php
        
        foreach ($data as $value) {
         
    ?>
    <tr id="<?=$value['id']?>_<?=$value['dateRes']?>">
    <td > <?=$value['nom']?></td>
    <td > <?=$value['prenom']?></td>
    <td><?=$value['email']?></td>
    <td><?=$value['classe']?></td>
    <td><button class="btn btn-danger" onclick="deleted(<?=$_GET['num']?>,<?=$_GET['numS']?>,`<?=$value['dateRes']?>`,<?=$value['id']?>,`<?=$value['id']?>_<?=$value['dateRes']?>`)" ><i class="material-icons">&#xe872;</i></button>
    </td>
    </tr>
    <?php
     }
    ?>
</table>
   
    </div>
    <?php
include 'footer.php';
?>
<script>
    if(<?=count($data)?><=6){
    let footer=document.getElementsByTagName('footer')[0];
    console.log("fffff")
    footer.classList.add('fixed-bottom');
    }

    function deleted(numc,nums,dateR,id,ligne){
        let data=new FormData();
        data.set('numc',numc);
        data.set('nums',nums);
        data.set('dateR',dateR);
        data.set('id',id);
        data.set('ligne',ligne);
        axios({
            method:'post',
            data:data,
            url:'delete.php'
        }).then((response)=>{
          document.getElementById(response.data).remove();
        }).catch((e)=>{

        })
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