<?php
 require_once('identifier.php');
 require_once("connexiondb.php");
  $idOffre=isset($_GET['idO'])?$_GET['idO']:0;
  $idUser=$_SESSION['user']['iduser'];
  //verifier si l'offre est deja postuler par l'utilisateur
    $requete="select * from demande_stage where idOffre=$idOffre and idUser=$idUser";
    $resultat=$pdo->query($requete);
    $tab=$resultat->fetch();
    if($tab!=null){
        $msg="Vous avez deja postuler a cette offre";
        $url="offres.php";
        header("location:alerte.php?message=$msg&url=$url");
    }
    else{
        $requete="insert into demande_stage(idOffre,idUser) values($idOffre,$idUser)";
        $resultat=$pdo->exec($requete);
        if($resultat){
            $msg="votre demande a ete bien enregistrer";
            $url="offres.php";
            header("location:alerte.php?msg=$msg&url=$url");
        }
        else{
            $msg="Erreur lors de la postulation";
            $url="offres.php";
            header("location:alerte.php?message=$msg&url=$url");
        }
    }
  
?>
