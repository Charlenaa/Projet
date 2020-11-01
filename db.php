<?php

try{
    $bd=new PDO('mysql:host=localhost;dbname=projet_reservation','root','');
}catch(Exception $e){
    echo 'erreur'; 
}
function getSalle(&$dat){
    global $bd;
    $req= $bd->query('select *, ((SELECT COUNT(*)
     from creneau WHERE creneau.Num_S=salle.Num_S)-
     (SELECT COUNT(*) from creneau NATURAL JOIN reserver
      where salle.Num_S=reserver.Num_S AND salle.Nbre_Place=(
          SELECT count(*) from reserver where reserver.num_C=creneau.num_C
      ))) as nb_creneau
       from salle WHERE EXISTS (SELECT * from creneau 
       where creneau.Num_S=salle.Num_S HAVING 
       salle.Nbre_Place >(SELECT COUNT(*)
     from reserver where reserver.Num_S=creneau.Num_S))');
    $data=$req->fetchAll(PDO::FETCH_ASSOC);
    $dat=$data;
}
function getSalleAll(&$dat){
    global $bd;
    $req= $bd->query('select *, ((SELECT COUNT(*)
     from creneau WHERE creneau.Num_S=salle.Num_S)-
     (SELECT COUNT(*) from creneau NATURAL JOIN reserver
      where salle.Num_S=reserver.Num_S AND salle.Nbre_Place=(
          SELECT count(*) from reserver where reserver.num_C=creneau.num_C
      ))) as nb_creneau
       from salle');
    $data=$req->fetchAll(PDO::FETCH_ASSOC);
    $dat=$data;
}
function getOneSalle(&$dat,$num){
    global $bd;
    $req=$bd->prepare('select * ,(salle.Nbre_Place-(SELECT COUNT(*)
     from reserver WHERE reserver.Num_S=creneau.Num_S AND reserver.num_C=
     creneau.num_C AND reserver.dateRes=creneau.dateRes )) as restant from salle NATURAL join creneau 
     WHERE salle.Num_S=:num AND creneau.dateRes=:dateR HAVING salle.Nbre_Place > 
     (SELECT COUNT(*) from reserver WHERE reserver.Num_S=creneau.Num_S 
    AND reserver.num_C=creneau.num_C AND reserver.dateRes=creneau.dateRes)');
    $req->bindParam(':num',$num);
    $dateR=date("Y-m-d");
    $req->bindParam(':dateR',$dateR);
    $req->execute();
    $dat=$req->fetchAll(PDO::FETCH_ASSOC);
}
function getOneSalleAll(&$dat,$num){
    global $bd;
    $req=$bd->prepare('select * ,(salle.Nbre_Place-(SELECT COUNT(*)
     from reserver WHERE reserver.Num_S=creneau.Num_S AND reserver.num_C=
     creneau.num_C AND reserver.dateRes=creneau.dateRes )) as restant from salle NATURAL join creneau 
     WHERE salle.Num_S=:num');
    $req->bindParam(':num',$num);
    $req->execute();
    $dat=$req->fetchAll(PDO::FETCH_ASSOC);
}
function getOneCreneau(&$dat,$numC,$date){
    global $bd;
    $req=$bd->prepare('select * ,(salle.Nbre_Place-(SELECT COUNT(*)
    from reserver WHERE reserver.Num_S=creneau.Num_S AND reserver.num_C=
    creneau.num_C AND reserver.dateRes=creneau.dateRes )) as restant from salle NATURAL join creneau 
    WHERE salle.Num_S=:num AND creneau.dateRes=:dateR HAVING salle.Nbre_Place > 
    (SELECT COUNT(*) from reserver WHERE reserver.Num_S=creneau.Num_S 
   AND reserver.num_C=creneau.num_C AND reserver.dateRes=creneau.dateRes)');
    $req->bindParam(':num',$numC);
    $req->bindParam(':dateR',$date);
    $req->execute();
    $dat=$req->fetchAll(PDO::FETCH_ASSOC);

}
function connexion($pseudo, $pass){
    global $bd;
    $req=$bd->prepare('select * from etudiant where pseudo=:pseudo');
$req->bindParam(':pseudo',$pseudo);
$req->execute();
$data=$req->fetchAll();
$_SESSION['jeton']='';
 if($data!=false){
if(password_verify($pass,$data[0]['mdp'])){
    echo '<br> pass correct';
    $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
    $_SESSION['ttl'] = time()+10*60;
    if($data[0]['droits']=='etudiant'){
        $_SESSION['user']=$data[0];
        header("Location:PageInformation.php?jeton=".$_SESSION['jeton']);
    }
    elseif($data[0]['droits']=='admin'){
        $_SESSION['user']=$data[0];
        header("Location:PageInformation.php?jeton=".$_SESSION['jeton']);
    }
     
      

}
else{
    $_SESSION['user']=array('droits'=>'aucun');
    header('Location:index.php');
    
}
}
else{
    $_SESSION['user']=array('droits'=>'aucun');
    header('Location:index.php');
   
}
}
function connectByCode($pseudo,$code){
    global $bd;
    $req=$bd->prepare('select * from etudiant where pseudo=:pseudo');
    $req->bindParam(':pseudo',$pseudo);
    $req->execute();
    $data=$req->fetchAll();
    $_SESSION['jeton']='';
    if($data!=false){
        
        $codeBd=explode('-',$data[0]['code_secret']);
        if(password_verify($codeBd[0],$code[0]) &&
        password_verify($codeBd[1],$code[1])&&
        password_verify($codeBd[2],$code[2]) &&
        password_verify($codeBd[3],$code[3]) &&
        password_verify($codeBd[4],$code[4]) &&
        password_verify($codeBd[5],$code[5])){
                $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
                $_SESSION['ttl'] = time()+10*60;
            if($data[0]['droits']=='etudiant'){
                $_SESSION['user']=$data[0];
                return 1;
                // le code 1 va m'aider à rediriger 
                //l'utilisateur vers sa page en fonction de ses acces
            }
            elseif($data[0]['droits']=='admin'){
                $_SESSION['user']=$data[0];
                return 2;
            }

        }
        else{
            $_SESSION['user']=array('droits'=>'aucun');
            return 3;
            
        }
        
    }
    else{
        $_SESSION['user']=array('droits'=>'aucun');
        return 4;
        
    }
    
    
}
function reservation(&$dat,$id){
    global $bd;
    $req= $bd->prepare('SELECT reserver.num_C as creneau, creneau.dateRes as 
    dat, reserver.Num_S as salle, date_Debut as 
    debut, date_Fin as fin, reserver.dateRes as dateR
    FROM reserver
    INNER join creneau on reserver.num_C=creneau.num_C
    WHERE reserver.id=:id');
    $req->bindParam(':id',$id);
    $req->execute();
    $data=$req->fetchAll(PDO::FETCH_ASSOC);
    $dat=$data;
}
function ListeEtudiant(&$dat,$cren,$numS){
    global $bd;
    $req=$bd->prepare('SELECT e.nom, e.prenom,e.id, e.email,e.classe, r.num_C, r.Num_S, c.date_Debut,c.date_Fin,c.dateRes
    FROM etudiant as e
    INNER JOIN reserver as r 
    ON e.id = r.id
    INNER JOIN creneau as c
    ON c.num_C = r.num_C
    where c.num_C =:numC and c.num_S=:numS');
    $req->bindParam(':numC',$cren);
    $req->bindParam(':numS',$numS);
    $req->execute();
    $dat=$req->fetchAll(PDO::FETCH_ASSOC);
}
function supprimerCreneau($num){
    global $bd;
    $req=$bd->prepare('DELETE FROM reserver where num_C=:num');
    $req->bindParam(':num',$num,PDO::PARAM_INT);
    $req->execute();
    $req=$bd->prepare('DELETE FROM creneau where num_C=:num');
    $req->bindParam(':num',$num,PDO::PARAM_INT);
    $req->execute();
}
function annuler($nums,$numc,$date,$id){
    global $bd;
    $req=$bd->prepare('DELETE FROM reserver where num_C=:numc AND
    Num_S=:nums and dateRes=:dateR and id=:id');
    $req->bindParam(':numc',$numc);
    $req->bindParam(':nums',$nums);
    $req->bindParam(':dateR',$date);
    $req->bindParam(':id',$id);
    $req->execute();
}
function modifier($id,$datD,$datF,$id_S){
    global $bd;
    $req=$bd->prepare('UPDATE creneau SET date_Debut=:datD, date_Fin=:datF where num_c=:id AND Num_S=:id_S');
    $req->bindParam(':datD',$datD);
    $req->bindParam(':datF',$datF);
    $req->bindParam(':id_S',$id_S,PDO::PARAM_INT);
    $req->bindParam(':id',$id,PDO::PARAM_INT);
    $req->execute();
}

function Creneau($datD,$datF,$NumS,$dateR){
    global $bd;
    $req=$bd->prepare('SELECT max(num_C) as Derniere_Val FROM creneau WHERE Num_S=:NumS');
    $req->bindparam(':NumS', $NumS);
    $req->execute();
    $data=$req->fetchAll(PDO::FETCH_ASSOC);
    $numC=$data[0]['Derniere_Val'];
    $numC++;
    $req=$bd->prepare('INSERT INTO creneau(date_Debut, date_Fin, Num_S,Num_C,dateRes) VALUES (:date_Debut, :date_Fin, :Num_S, :Num_C,:dateR)  ');
    $req->bindParam(':date_Debut',$datD);
    $req->bindParam(':date_Fin',$datF);
    $req->bindParam(':Num_S',$NumS);
    
    $req->bindParam(':Num_C',$numC);
    $req->bindParam(':dateR',$dateR);
    $req->execute();


}
function getAllSalle(&$dat){
    global $bd;
    $req=$bd->query('select * from salle');
    $dat=$req->fetchAll(PDO::FETCH_ASSOC);
}
function deleteEtudiant($date,$id,$numS,$numc){
    global $bd;
    $req=$bd->prepare('delete from reserver where dateRes=:date and num_s=:nums and num_c=:numc and id=:id');
    $req->bindParam(':id',$id);
    $req->bindParam(':nums',$numS);
    $req->bindParam(':numc',$numc);
    $req->bindParam(':date',$date);
    $req->execute();
}
function updateSalle($numS,$nb){
    global $bd;
    $req=$bd->prepare('UPDATE salle SET Nbre_Place=:nb WHERE Num_S=:nums');
    $req->bindParam(':nb',$nb);
    $req->bindParam(':nums',$numS);
    $req->execute();
    $req=$bd->prepare('SELECT COUNT(*) as nb from reserver WHERE Num_S=:nums');
    $req->bindParam(':nums',$numS);
    $req->execute();
    $data=$req->fetch(PDO::FETCH_ASSOC);
    if($data['nb']>=$nb){
        $req=$bd->prepare('DELETE FROM reserver where Num_S=:nums');
        $req->bindParam(':nums',$numS);
        $req->execute();
    }

}
function getCommentaires(&$dat){
    global $bd;
    $req=$bd->query('select * from commentaire natural join etudiant order by date_c ');
    $dat=$req->fetchAll(PDO::FETCH_ASSOC);
}
function getReponses(&$dat,$idc){
    global $bd;
    $req=$bd->prepare('select * from reponse natural join etudiant where id_com=:idc');
    $req->bindParam(':idc',$idc);
    $req->execute();
    $dat=$req->fetchAll(PDO::FETCH_ASSOC);
}
function insertCommentaire($id,$message,$date){
    global $bd;
    $req=$bd->prepare('insert into commentaire(id,message,date_c) values(:id,:message,:date)');
    $req->bindParam(':id',$id);
    $req->bindParam(':message',$message);
    $req->bindParam(':date',$date);
    $req->execute();
}
function insertReponse($id,$message,$date,$idC){
    global $bd;
    $req=$bd->prepare('insert into reponse(id,message,date_c,id_com) values(:id,:message,:date,:idc)');
    $req->bindParam(':id',$id);
    $req->bindParam(':message',$message);
    $req->bindParam(':date',$date);
    $req->bindParam(':idc',$idC);
    $req->execute();
}