<?php
        session_start();
        if(isset($_SESSION['user']) ){
            
            if($_SESSION['user']['role']=='ADMIN'){
               
                require_once('connexiondb.php');
                
                $idS=isset($_GET['idS'])?$_GET['idS']:0;
                  //suprimer les stages dans lesquels le stagiaire est inscrit
                  $requete2="delete from stages where idStagiaire=?";
                  $params=array($idS);
                
                  $resultat=$pdo->prepare($requete2);
                  
                  $resultat->execute($params);

                $requete="delete from stagiaire where idStagiaire=?";

                $params=array($idS);
                
                $resultat=$pdo->prepare($requete);
                
                $resultat->execute($params);
                
                header('location:stagiaire.php'); 
                
            }else{
                $message="Vous n'avez pas le privilège de supprimer un stagiaire!!!";
                
                $url='stagiaires.php';
                
                header("location:alerte.php?message=$message&url=$url"); 
            }
           
        }else {
                header('location:login.php');
        }
?>