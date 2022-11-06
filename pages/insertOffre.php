<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $sujetStage=isset($_POST['sujet_stage'])?$_POST['sujet_stage']:"";
    $sujetStage=filter_var($sujetStage,FILTER_SANITIZE_STRING);
    $dateDebut=isset($_POST['date_debut'])?$_POST['date_debut']:"";

    $dateFin=isset($_POST['date_fin'])?$_POST['date_fin']:"";
    $idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:"";
   
    if($sujetStage=="" || $dateDebut=="" || $dateFin=="")
    {
    header("location:nouvelleOffre.php?msg=Veuillez remplir tous les champs");

    }
   else {
        $requete="insert into offre_stage(sujet_stage,date_debut,date_fin,idFiliere) values('$sujetStage','$dateDebut','$dateFin',$idFiliere)";
        $resultat=$pdo->exec($requete);

        header('location:offres.php');
       
    }
    
    
?>