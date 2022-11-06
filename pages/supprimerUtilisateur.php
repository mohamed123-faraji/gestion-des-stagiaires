<?php
     session_start();
    if(isset($_SESSION['user'])){
        
            require_once('connexiondb.php');
            
            $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;
            //verifieri si l'utilisateur existe dans table stagiaire
            $requete="select * from stagiaire where iduser=$idUser";
            $resultat=$pdo->query($requete);
            $stagiaire=$resultat->fetch();
                if($stagiaire==null){
                        $requete="delete from utilisateur where idUser=?";
            
                        $params=array($idUser);
                        
                        $resultat=$pdo->prepare($requete);
                        
                        $resultat->execute($params);
                        
                      header('location:users.php');
        
                }   
                else {
                $msg="Suppression impossible: ce utilisateur est un stagiaire";
                 header("location:alerte.php?message=$msg");
                }
            
     }else {
                header('location:login.php');
        }
    
?>