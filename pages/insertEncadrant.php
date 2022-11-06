<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    $nom=filter_var($nom,FILTER_SANITIZE_STRING);
    $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
    $prenom=filter_var($prenom,FILTER_SANITIZE_STRING);
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    $adresse=filter_var($adresse,FILTER_SANITIZE_STRING);
    $telephone=isset($_POST['telephone'])?$_POST['telephone']:"";
    $telephone=filter_var($telephone,FILTER_SANITIZE_STRING);
     if($nom=="" || $prenom=="" || $adresse=="" || $telephone==""){
        header("location:nouveauEncadrant.php?msg=Veuillez remplir tous les champs");
     }
     else{
    $requet= "insert into encadrants(nom,prenom,adresse,telephone) values(?,?,?,?)";
    $params=array($nom,$prenom,$adresse,$telephone);
    $resultat=$pdo->prepare($requet);
    $resultat->execute($params);

    
    header('location:encadrants.php');
     }

?>