<?php
session_start();
$user=$_SESSION['user'];
if($user['droits']=='admin' && $_SESSION['jeton']==$_GET['jeton'] && $_SESSION['jeton']!=''){
include('db.php');
if(time()>=$_SESSION['ttl']){
    $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
    $_SESSION['ttl']=time()+10*60;
}
$data;
$id=$_GET['id'];
getOneSalleAll($data,$id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salle <?=$id?></title>
</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<?php
		include("header.php");
     ?>
    <div id="app" class="container" style="margin-top:45px">
    <h1 class="text-center p-2">Infos salle <?=$id?> <button class="btn" onclick="modifierSalle(<?=$_GET['id']?>)"><i class="material-icons">&#xe150;</i></button></h1>
    <div class="p-2 pb-3"> 
        <a href="newCreneau.php?place=<?=$_GET['place']?>&jeton=<?=$_SESSION['jeton']?>">Ajouter un nouveau creneau</a>
    </div>
<table class="table table-bordered table-hover table-secondary">
    <tr>
        <th>Numero du créneau</th>
        <th>Date du créneau</th>
        <th>Heure de debut</th>
        <th>Heure de fin</th>
        <th>Nombre de places disponibles</th>
        <th>Nombre de places totales</th>
        <th>Actions sur créneau</th>
    </tr>
    <?php
        
        foreach ($data as $value) {
         
    ?>
    <tr ondblclick="detail(<?=$value['num_C']?>,`<?=$value['date_Debut']?>`,`<?=$value['date_Fin']?>`,<?=$value['Nbre_Place']?>,`<?=$value['dateRes']?>`)" id="<?=$value['num_C']?>+c">
    <td > <?=$value['num_C']?></td>
    <td > <?=$value['dateRes']?></td>
    <td><?=$value['date_Debut']?></td>
    <td><?=$value['date_Fin']?></td>
    <td class="restante" id="<?=$value['restant']?>+<?=$value['num_C']?>"><?=$value['restant']?></td>
    <td class="nbplace"><?=$value['Nbre_Place']?></td>
    <td><button class="btn btn-primary" id= "<?=$value['num_C']?>+b" onclick="modifier(<?=$value['num_C']?>,`<?=$value['date_Debut']?>`,`<?=$value['date_Fin']?>`,<?=$value['Nbre_Place']?>)"><i class="material-icons">&#xe150;</i></button>
    <button class="btn btn-danger" id= "<?=$value['num_C']?>+b" onclick="supprimer(<?=$value['num_C']?>)"><i class="material-icons">&#xe872;</i></button>
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
    footer.classList.add('fixed-bottom');
    }
    function detail(numC,datD,datF,nb,date){
        document.location.href="detailCreneau.php?num="+numC+"&numS=<?=$id?>&datD="+datD+"&datF="+datF+"&nb="+nb+"&jeton=<?=$_SESSION['jeton']?>&date="+date;
    }

    function supprimer(numC){
        if(confirm(`Vous êtes sur le point de supprimer le créneau ${numC}
ainsi que toutes les réservations affectées
Voulez vous vraiment continuer ?`)){
            var data = new FormData();
        data.set('num',numC);
        axios({
            method:'post',
            url:'suppression.php?jeton=<?=$_SESSION['jeton']?>',
            data:data
        }).then((response)=>{
            if(response.data!='erreur'){
            console.log(response.data)
            
            let res=document.getElementById(response.data+'+c');
            let tab=res.parentElement;
            console.log(res);
            tab.removeChild(res);
            }
            else{
                console.log('Pas le droit de supprimer');
            }
        })
        }
        
    }
    function modifier(numC,datD,datF,nb){
        document.location.href="modifierC.php?numC="+numC+"&numS=<?=$id?>&datD="+datD+"&datF="+datF+"&nb="+nb+"&jeton=<?=$_SESSION['jeton']?>";
    }
    function modifierSalle(nums){
        let newnb=prompt('Modifier le nombre de place de la salle',<?=$_GET['place']?>);
        if(newnb!=null){
        let data= new FormData();
        data.set('nb',newnb);
        data.set('nums',nums);
        axios({
            method:'post',
            url:'updateSalle.php?jeton=<?=$_SESSION['jeton']?>',
            data:data
        }).then((response)=>{
            console.log(response.data);
            let restante=document.getElementsByClassName('restante');
            let nbplace=document.getElementsByClassName('nbplace');
            for(i=0;i<response.data.length;i++){
                restante[i].innerHTML=response.data[i].restant;
                nbplace[i].innerHTML=response.data[i].Nbre_Place;
            }

        }).catch((e)=>console.error(e))

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