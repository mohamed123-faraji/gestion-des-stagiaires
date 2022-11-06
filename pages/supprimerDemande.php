<?php
        session_start();
        if(isset($_SESSION['user']) ){
            
            if($_SESSION['user']['role']=='ADMIN'){
               
                require_once('connexiondb.php');
                
                $idd=isset($_GET['idD'])?$_GET['idD']:0;

                $requet="delete from demande_stage where idDemande=?";
                $params=array($idd);
                $resultat=$pdo->prepare($requet);
                $resultat->execute($params);
                header('location:demande_stage.php'); 
                
            }else{
                $message="Vous n'avez pas le privilège de supprimer une demande!!!";
                
                $url='demande_stage.php';
                
                header("location:alerte.php?message=$message&url=$url"); 
            }
           
        }else {
                header('location:login.php');
        }
?>