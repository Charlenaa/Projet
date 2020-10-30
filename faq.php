<?php
session_start();
include('db.php');
$data;
$data2;
getCommentaires($data);

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
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
     
  <div class="d-flex p-2 bd-highlight mt-5" style="height:100%;">
  <div class="mx-auto">
  <div >
      <?php
      foreach($data as $value){
          getReponses($data2,$value['id_com']);
      ?>
      <div class="card m-2" style="width: 42rem;">
  <div class="card-body">
    <h5 class="card-title"><?=$value['pseudo']?></h5>
    <h6 class="card-subtitle mb-2 text-muted font-italic"><?=$value['date_c']?></h6>
    <p class="card-text"><?=$value['message']?></p>
    <?php
    foreach($data2 as $val){
    ?>
    <div class="card">
  <div class="card-header">
    Réponse du <?=$val['date_c']?>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p> <?=$val['message']?></p>
      <footer class="blockquote-footer">De <cite title="Source Title"> <?=$val['pseudo']?></cite></footer>
    </blockquote>
  </div>
</div>
<?php
    }
    ?>
    <button class="btn btn-primary" onclick="repondre(<?=$user['id']?>,`<?=date('Y-m-d H:i:s')?>`,<?=$value['id_com']?>)">Répondre</button>
  </div>
</div>
<?php
}?>
    <button class="btn btn-primary" onclick="showMess()">Nouveau commentaire</button>
    <div class="invisible" id="mess">
    <div class="form-group">
          <label for="message" style="color:aliceblue">Votre Message</label>
          <textarea name="" id="comm" cols="30" rows="5" class="form-control"></textarea>
      </div>
      <div class="form-group">
          <button class="btn btn-success" onclick="commenter(<?=$user['id']?>,`<?=date('Y-m-d H:i:s')?>`)">Envoyer</button>
          <button class="btn btn-danger" onclick="hideMess()">Annuler</button>
      </div>
    </div>
     
 </div>
</div>
</div>
<?php
include 'footer.php';
?>
<script>
    function repondre(id,date,idc){
        let message=prompt("Saisissez votre réponse !!");
        if(message!=null){
        let data=new FormData();
        data.set('id',id);
        data.set('message',message);
        data.set('date',date);
        data.set('idc',idc);
        axios({
            data:data,
            method:'post',
            url:'reponse.php'
        }).then((data)=>{
            document.location.href="faq.php";
        })
        }
    }
    function commenter(id,date){
        let message=document.getElementById('comm').value;
        if(message!=null){
        let data=new FormData();
        data.set('id',id);
        data.set('message',message);
        data.set('date',date);
        axios({
            data:data,
            method:'post',
            url:'commentaire.php'
        }).then((data)=>{
            document.location.href="faq.php";
        })
        }
    }
    function showMess(){
        let mess=document.getElementById('mess');
        mess.classList.add('visible');
        mess.classList.remove('invisible');
    }
    function hideMess(){
        let mess=document.getElementById('mess');
        mess.classList.add('invisible');
        mess.classList.remove('visible');
    }
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