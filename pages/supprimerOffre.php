<?php
        session_start();
        if(isset($_SESSION['user']) ){
            
            if($_SESSION['user']['role']=='ADMIN'){
               
                require_once('connexiondb.php');
                
                $ido=isset($_GET['idO'])?$_GET['idO']:0;

                $requet="delete from offre_stage where idOffre=?";
                $params=array($ido);
                $resultat=$pdo->prepare($requet);
                $resultat->execute($params);
                header('location:offres.php'); 
                
            }else{
                $message="Vous n'avez pas le privilège de supprimer un stagiaire!!!";
                
                $url='offres.php';
                
                header("location:alerte.php?message=$message&url=$url"); 
            }
           
        }else {
                header('location:login.php');
        }
?>