<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $ido=isset($_POST['idO'])?$_POST['idO']:0;
    $sujet=isset($_POST['sujet_stage'])?$_POST['sujet_stage']:"";
    $dateD=isset($_POST['date_debut'])?$_POST['date_debut']:"";
    $dateF=isset($_POST['date_fin'])?$_POST['date_fin']:"";
    $idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:"";
    
    
    
    $requete="update offre_stage set sujet_stage=?, date_debut=?, date_fin=?, idFiliere=? where idOffre=?";
    $params=array($sujet,$dateD,$dateF,$idFiliere,$ido);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    header('location:offres.php');
    

    
    
  

?>
