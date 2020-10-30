<?php
try{
    $bd=new PDO('mysql:host=localhost;dbname=projet_reservation','root','');
}catch(Exception $e){
    echo 'erreur'; 
}
$req=$bd->query('select * from etudiant');
$data=$req->fetchAll();
foreach ($data as $value) {
    $mdp=$value['mdp'];
    $code=$value['code_secret'];
    $codeHash='';
    for($i=0;$i<6;$i++) {
        $codeHash=$codeHash.''.sha1('CST'.$code[$i]);
    }
    $codeHash=sha1($codeHash);
    $newMdp=password_hash($mdp,PASSWORD_DEFAULT);
    $req=$bd->prepare('update etudiant set mdp=:mdp,code_secret=:code where id=:id');
    $req->bindParam(':mdp',$newMdp);
    $req->bindParam(':code',$codeHash);
    $req->bindParam(':id',$value['id']);
    $req->execute();
}
