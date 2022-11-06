<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idSt=isset($_POST['idSt'])?$_POST['idSt']:0;
    $idOffre=isset($_POST['idOffre'])?$_POST['idOffre']:"";
    $idStagiaire=isset($_POST['idStagiaire'])?$_POST['idStagiaire']:"";
    $idEncadrant=isset($_POST['idEncadrant'])?$_POST['idEncadrant']:"";
    //selectionner l'encadrant dans combien de stages il est encadrant
    $requete="select count(*) as nb from stages where idEncadrant=$idEncadrant";
    $resultat=$pdo->query($requete);
    $nb=$resultat->fetch();     
    //selectionner le stagiaire dans combien de stages il est stagiaire dans cette periode
    $requete="select count(*) as nb from stages st,offre_stage o where st.idOffre=o.idOffre and idStagiaire=$idStagiaire and date_debut<='$dateD' and date_fin>='$dateF'";
    $resultat=$pdo->query($requete);
    $nb2=$resultat->fetch();
    if($nb['nb']<5 && $nb2['nb']<=1){
    $requete="update stages set idOffre=?, idStagiaire=?, idEncadrant=? where idStage=?";
    $params=array($idOffre,$idStagiaire,$idEncadrant,$idSt);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    header('location:stages.php');
    }
    else{
        $erreur="vous ne pouvez pas modifier ce stage, car l'encadrant a deja 5 stages ou le stagiaire a deja un stage dans cette periode";
        $url="updateStage.php?idS=$idSt";
        //redirection vers la page d'alerte
        header('location:alerte.php?message='.$erreur);

    }
    
  

?>
