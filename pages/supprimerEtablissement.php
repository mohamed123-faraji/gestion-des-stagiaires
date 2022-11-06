<?php
    session_start();
        if(isset($_SESSION['user'])){
            
            require_once('connexiondb.php');
            $ide=isset($_GET['idE'])?$_GET['idE']:0;

            $requeteStag="select count(*) countStag from stagiaire where idEtablissement=$ide";
            $resultatStag=$pdo->query($requeteStag);
            $tabCountStag=$resultatStag->fetch();
            $nbrStag=$tabCountStag['countStag'];
            
            if($nbrStag==0){
                $requete="delete from etablissements where idEtablissement=?";
                $params=array($ide);
                $resultat=$pdo->prepare($requete);
                $resultat->execute($params);
                header('location:etablissement.php');
            }else{
                $msg="Suppression impossible: Vous devez supprimer tous les stagiaires de cette etablissement";
                //echo "<script>alert('$msg');</script>";
               // header('location:etablissement.php');
               $url="etablissement.php";
                header("location:alerte.php?message=$msg&url=$url");
            }
            
         }else {
                header('location:login.php');
        }
    
    
    
    
?>