<?php
try{
    $bd=new PDO('mysql:host=localhost;dbname=projet_reservation','root','');
}catch(Exception $e){
    echo 'erreur'; 
}
function  verif($id,$num_c,$num_s,$date){
    $dateA= date("Y-m-d");
    $dateC= array('0000-00-00');
    if(in_array($date,$dateC) || $date<$dateA){
        return 'date';
    }
    global $bd;
    $req=$bd->prepare('select * from reserver
     where id=:id AND num_s=:num_s AND num_c=:num_c
     AND dateRes=:date');
     $req->bindParam(':num_s',$num_s,PDO::PARAM_INT);
    $req->bindParam(':num_c',$num_c,PDO::PARAM_INT);
    $req->bindParam(':date',$date);
    $req->bindParam(':id',$id,PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll();
}
function reserver($id,$num_c,$num_s,$date){
    if(is_string(verif($id,$num_c,$num_s,$date)) && strcmp(verif($id,$num_c,$num_s,$date),'date')==0){
        return 'Impossible pour cette date ';
    }
    elseif(verif($id,$num_c,$num_s,$date)==false){
    global $bd;
    $req=$bd->prepare('insert into reserver(num_s,num_c,id,dateRes)value(:num_s,:num_c,:id,:date)');
    $req->bindParam(':num_s',$num_s,PDO::PARAM_INT);
    $req->bindParam(':num_c',$num_c,PDO::PARAM_INT);
    $req->bindParam(':date',$date);
    $req->bindParam(':id',$id,PDO::PARAM_INT);
    $req->execute();
    return 'réservation reuissie ';
    }
    
    else{
        return 'Vous avez déja reservé ';
    }
}
session_start();
$user=$_SESSION['user'];
$message=reserver($user['id'],$_POST['numC'],$_POST['numS'],$_POST['dateR']);

$resp=array('message'=>$message, 'id'=>$_POST['numC'],'nb'=>$_POST['nb']);
echo json_encode($resp);
?>