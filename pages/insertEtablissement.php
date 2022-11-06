<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $nomE=isset($_POST['nomE'])?$_POST['nomE']:"";
     //adresse de l'etablissement
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    //if nome ou adresse est vide redirection vers la page nouvelleEtablissement.php avec un message d'erreur
    if($nomE=="" || $adresse==""){
        header('location:nouvelleEtablissement.php?msg=Veuillez remplir tous les champs');
    }
    else
    {

    $requete="insert into etablissements(nomEtablissement,adresse) values(?,?)";
    $params=array($nomE,$adresse);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:etablissement.php');
    }
?>