<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
    $nomf=filter_var($nomf,FILTER_SANITIZE_STRING);
    $niveau=isset($_POST['niveau'])?strtoupper($_POST['niveau']):"";
    $niveau=filter_var($niveau,FILTER_SANITIZE_STRING);
    if($nomf=="" || $niveau==""){
        header("location:nouvelleFiliere.php?msg=Veuillez remplir tous les champs");
    }
    else{
        $requete="insert into filiere(nomFiliere,niveau) values(?,?)";
        $params=array($nomf,$niveau);
        $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
        
        header('location:filieres.php');
    }
    
    
?>