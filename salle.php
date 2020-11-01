<?php
session_start();
$user=$_SESSION['user'];
if(($user['droits']=='etudiant' || $user['droits']=='admin') ){
    if(time()>=$_SESSION['ttl']){
        $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
        $_SESSION['ttl']=time()+10*60;
    }
include('db.php');
$data;
if(isset($_POST['numS'])){
    $id=$_POST['numS'];
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
getOneSalle($data,$id);
if(isset($_POST['dateR'])){
    getOneCreneau($data,$id,$_POST['dateR']);
}
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
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salle <?=$id?></title>
</head>
<body style="height:100%; background:no-repeat url('salle.jpg');background-size:cover ">
<?php
		include("header.php");
     ?>
    <div id="app" class="container" style="margin-top:70px">
    <h1 class="text-center pb-2">Infos salle <?=$id?></h1>
    <div class="mx-auto w-50">
    <form class="form-inline " id="dateF"  method="POST">
  <div class="form-group mb-2">
    <label for="staticEmail2" class="sr-only">Date</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Date de réservation">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="date" name="dateR" class="form-control" id="inputPassword2" 
    placeholder="Password" value="<?php if(isset($_POST['dateR'])){echo $_POST['dateR'];}
    else{echo date("Y-m-d") ;}?>">
  </div>
  <input type="hidden" name="id" value=<?=$id?>>
  <button type="submit" class="btn btn-primary mb-2" >Confirmer</button>
</form>
    </div>
<table class="table table-bordered table-secondary" id="crenSalle">
    <tr>
        <th>Numero du créneau</th>
        <th>Date de debut</th>
        <th>Date de fin</th>
        <th>Nombre de places disponibles</th>
        <th>Nombre de places totales</th>
        <th>Action</th>
    </tr>
    <?php
        
        foreach ($data as $value) {
         
    ?>
    <tr id="<?=$value['num_C']?>li">
    <td > <?=$value['num_C']?></td>
    <td><?=$value['date_Debut']?></td>
    <td><?=$value['date_Fin']?></td>
    <td id="<?=$value['restant']?>+<?=$value['num_C']?>"><?=$value['restant']?></td>
    <td ><?=$value['Nbre_Place']?></td>
    <td><button class="btn btn-primary" id= "<?=$value['num_C']?>+b" onclick="reserver(<?=$value['Num_S']?>,<?=$value['num_C']?>,<?=$value['restant']?>+'+'+<?=$value['num_C']?>,
    document.getElementsByName('dateR')[0].value)">Reserver</button>
    <br><span id="<?=$value['num_C']?>" class="text-success font-italic font-weight-bold"></span></td>
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
    function reserver(numS,numC,nb,dateR){
        if(dateR==''){
            dateR='0000-00-00'
        }
        console.log(dateR);
        var data = new FormData();
        data.set('numS',numS);
        data.set('numC',numC);
        data.set('nb',nb);
        data.set('dateR',dateR);
       axios({
           method:'post',
           url:'reserver.php',
           data:data
       }).then((response)=>{
          let tab = document.getElementById(response.data.id);
          console.log(response);
          let disp = document.getElementById(response.data.nb);
          if(response.data.message=='réservation reuissie '){
         disp.innerHTML = Number(response.data.nb.split('+')[0])-1;
          }
          else{
            let classMess=tab.classList;
            classMess.remove('text-success');
         classMess.add('text-danger');
          }
         let btn= document.getElementById(response.data.id+"+b");
         btn.disabled=true;
         
         
           tab.appendChild(document.createTextNode(response.data.message))
           if(response.data.message=='réservation reuissie '){
            tab.innerHTML+="<i style='font-size:24px' class='fas'>&#xf164;</i>";
            setTimeout(function(){
                document.location.href="reservation.php?jeton=<?=$_SESSION['jeton']?>";
            },5000);
           }
           else{
            tab.innerHTML+="<i style='font-size:24px' class='fas'>&#xf071;</i>";
           }

       }).catch((error)=>console.error(error));
       
    }
    function checkReserve(numS,dateR){
        console.log(`${numS} : ${dateR}`);
        if(dateR==''){
            dateR='0000-00-00'
        }
        var data = new FormData();
        data.set('numS',numS);
        data.set('dateR',dateR);
        axios({
            method:'post',
            url:'salle.php',
            data:data
        }).then((response)=>{
            var cren= document.getElementsByTagName('table')[0].children[0].children;
            let header=cren[0].cloneNode(true);
            console.log(header);
            let tbody=cren[0].parentElement.cloneNode(false);
            tbody.appendChild(header);
            cren[0].parentElement.remove();
            console.log(response.data);
            document.getElementsByTagName('table')[0].appendChild(tbody);
        }).catch((e)=>console.error(e))
    }
   let formdate=document.getElementById('dateF');
   formdate.onsubmit=function(e){
    let dat=new Date();
   let datR=new Date(document.getElementsByName('dateR')[0].value)
   let datString = dat.getFullYear()+'-'+dat.getMonth()+'-'+dat.getDay();
//    if(datR.getTime()< dat.getTime()){
//        console.log(datString)
//     document.getElementsByName('dateR')[0].value=datString;
//    }
       checkReserve(document.getElementsByName('id')[0].value,
       document.getElementsByName('dateR')[0].value)
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