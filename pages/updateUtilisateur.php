<?php
    require_once('identifier.php');

    require_once('connexiondb.php');

    $iduser=isset($_POST['iduser'])?$_POST['iduser']:0;

    $login=isset($_POST['login'])?$_POST['login']:"";

    $email=isset($_POST['email'])?strtoupper($_POST['email']):"";
    $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
    $civilite=isset($_POST['civilite'])?$_POST['civilite']:"F";
    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    
    
    //les photos doit d'extension png,jpg,jpeg,gif,svg,webp,tiff,bmp
     $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' , 'webp' , 'tiff' , 'bmp' );
        $extension_upload = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) )
        {
            $imageTemp=$_FILES['photo']['tmp_name'];
            move_uploaded_file($imageTemp,"../images/".$nomPhoto);
        }
        
        
    //if nomphoto est vide alors on ne modifie pas la photo else on modifie la photo
    if(!empty($nomPhoto)){
        $requete="update utilisateur set login=?,email=?,prenom=?,civilite=?,photo=? where iduser=?";
        $params=array($login,$email,$prenom,$civilite,$nomPhoto,$iduser);
    }else{
        $requete="update utilisateur set login=?,email=?,prenom=?,civilite=? where iduser=?";
        $params=array($login,$email,$prenom,$civilite,$iduser);
    }
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    header('location:users.php');
?>
