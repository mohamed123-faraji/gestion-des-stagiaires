<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idEtablissement=isset($_POST['idEtablissement'])?$_POST['idEtablissement']:1;
    $iduser=isset($_POST['iduser'])?$_POST['iduser']:0;
    if($idEtablissement=="" || $iduser=="" ){
        header("location:nouveauStagiaire.php?msg=Veuillez remplir tous les champs");
     }
    //verification de l'existence de l'utilisateur deja dans stagiaire
    $requete="select * from stagiaire where iduser=$iduser";
    $resultat=$pdo->query($requete);
    $stagiaire=$resultat->fetch();
    if(!$stagiaire){
    $requete="insert into stagiaire(iduser,idEtablissement) values(?,?)";
    $params=array($iduser,$idEtablissement);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    header("location:stagiaire.php");
    }else{
        $message="L'utilisateur est deja dans la liste des stagiaires";
        header('location:nouveauStagiaire.php?msg=Utilisateur est deja dans la liste des stagiaires');
    }
   

?>