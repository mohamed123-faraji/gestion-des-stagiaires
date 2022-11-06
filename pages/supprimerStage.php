<?php
        session_start();
        if(isset($_SESSION['user']) ){
            
            if($_SESSION['user']['role']=='ADMIN'){
               
                require_once('connexiondb.php');
                
                $idSt=isset($_GET['idSt'])?$_GET['idSt']:0;

                $requet="delete from stages where idStage=?";
                $params=array($idSt);
                $resultat=$pdo->prepare($requet);
                $resultat->execute($params);
                header('location:stages.php'); 
                
            }else{
                $message="Vous n'avez pas le privilège de supprimer un stagiaire!!!";
                
                $url='stages.php';
                
                header("location:alerte.php?message=$message&url=$url"); 
            }
           
        }else {
                header('location:login.php');
        }
?>