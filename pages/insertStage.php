<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idOffre=isset($_POST['idOffre'])?$_POST['idOffre']:"";
    $idStagiaire=isset($_POST['idStagiaire'])?$_POST['idStagiaire']:"";
    $idEncadrant=isset($_POST['idEncadrant'])?$_POST['idEncadrant']:"";
    //selection les informations d'offre
    $requete="select date_debut,date_fin from offre_stage where idOffre=$idOffre";
    $resultat=$pdo->query($requete);
    $offre=$resultat->fetch();
    $dateDebut=$offre['date_debut'];
    $dateFin=$offre['date_fin'];
    //l'encadrant doit etre encadrant dans 5 stages
    if($idOffre=="" || $idStagiaire=="" || $idEncadrant=="")
    {
    header("location:nouvelleStage.php?msg=Veuillez remplir tous les champs");

    }
    else{
   
    $requete="select distinct count(*) countS from stages where idEncadrant=$idEncadrant";
    $resultat=$pdo->query($requete);
    $tab=$resultat->fetch();
    $countS=$tab['countS'];
    if($countS >= 5){
        $msg="L'encadrant a deja 5 stages";
        $url="nouvelleStage.php?msg=$msg";
        header("location:alerte.php?message=$msg&url=$url");
        exit();
    }
     //le stagiaire a une seule stage dans une periode donc on ne peut pas avoir deux stages dans une meme periode
     $requete="select idStagiaire,stages.idOffre,sujet_stage,date_debut,date_fin from stages,offre_stage where stages.idOffre=offre_stage.idOffre and idStagiaire=$idStagiaire and date_debut<='$dateDebut' and date_fin>='$dateFin'";
     $resultat=$pdo->query($requete);
     $nb=$resultat->rowCount();
   if($nb==0){
        $requete="insert into stages(idOffre,idStagiaire,idEncadrant) values('$idOffre',$idStagiaire,$idEncadrant)";
        $resultat=$pdo->exec($requete);

        header('location:stages.php');
       
    }
    else{
        //redirection vers la page d'insertion de stage avec un message d'erreur
        $erreur="Ce stagiaire a deja un stage dans cette periode";
        $url="stages.php";
        header("location:alerte.php?message=$erreur&url=$url");
    }
}
    
?>