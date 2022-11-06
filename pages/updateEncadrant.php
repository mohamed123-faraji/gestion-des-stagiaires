<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idEn=isset($_POST['idEn'])?$_POST['idEn']:0;
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    $tel=isset($_POST['telephone'])?$_POST['telephone']:"";
    $requete="update encadrants set nom='$nom',prenom='$prenom',adresse='$adresse',telephone='$tel' where idEncadrant=$idEn";
    $resultat=$pdo->exec($requete);
    
    header('location:encadrants.php');

?>
