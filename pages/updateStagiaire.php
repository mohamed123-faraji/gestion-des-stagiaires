<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idS=isset($_POST['idS'])?$_POST['idS']:0;
    
    $idEtablissement=isset($_POST['idEtablissement'])?$_POST['idEtablissement']:0;
    $iduser=isset($_POST['iduser'])?$_POST['iduser']:0;

    $requete="update stagiaire set idEtablissement=?,iduser=? where idStagiaire=?";
    $params=array($idEtablissement,$iduser,$idS);
   
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:stagiaire.php');

?>
