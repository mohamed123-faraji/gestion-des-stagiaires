<?php
        session_start();
        if(isset($_SESSION['user']) ){
            
            if($_SESSION['user']['role']=='ADMIN'){
               
                require_once('connexiondb.php');
                
                $idEn=isset($_GET['idEn'])?$_GET['idEn']:0;
                //verifier si encadrant existe dans table stages
                $requete="select * from stages where idEncadrant=$idEn";
                $resultat=$pdo->query($requete);
                $nb=$resultat->rowCount();
                if($nb==0){
                    $requete="delete from encadrants where idEncadrant=$idEn";
                    $resultat=$pdo->exec($requete);
                    header('location:encadrants.php');
                }
                else{
                    $msg="Suppression impossible: Vous devez supprimer tous les stages de cet encadrant";
                    
                    header("location:alerte.php?message=$msg");
                }

            }else{
                $message="Vous n'avez pas le privilège de supprimer un stagiaire!!!";
                
                $url='stagiaires.php';
                
                header("location:alerte.php?message=$message&url=$url"); 
            }
           
        }else {
                header('location:login.php');
        }
?>