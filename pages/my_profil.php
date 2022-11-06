<?php 
 require_once('identifier.php');
 require_once('connexiondb.php');
 $contenu="";
  if(isset($_GET['idUser'])){
 $id=isset($_GET['idUser'])?$_GET['idUser']:0;
  }
  else{
      $id=0;
  }

 $requete="select * from utilisateur where iduser=$id";

 $resultat=$pdo->query($requete);
 $utilisateur=$resultat->fetch();
 $login=$utilisateur['login'];
 $email=$utilisateur['email']?$utilisateur['email']:"";
 $photo=$utilisateur['photo']?$utilisateur['photo']:"";
 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Account Page | Gestion Stagiaires</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">

<link rel="stylesheet" href="../assets/css/feathericon.min.css">

<link rel="stylesheet" href="../assets/plugins/morris/morris.css">

<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="main-wrapper">
<?php include 'navBar.php'; ?>
<?php include 'sideBar.php'; ?>
<div class="page-wrapper">
<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Profil Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active">Profil</li>
</ul>
</div>
</div>
</div>
<div class="row settings-tab">
<div class="col-md-4">
<div class="card">
<div class="card-header all-center">
<form  id="form" action='' method='POST' enctype='multipart/form-data'> 
<a href="" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="<?php echo '../images/'.$utilisateur['photo']; ?>" alt="User Image"></a>
<div class='form-group'>
<!-- <label for='iduser'>id user:</label> -->
 <input type='hidden' name='iduser' class='form-control' value="<?php echo $utilisateur['iduser'];?>">
</div>
    <input type='file'  id="photo" name='photo' accept=".jpeg,.png,.jpg">
  </form>
  <script type="text/javascript">
    document.getElementById("photo").onchange = function(){
      document.getElementById("form").submit();
    }
  </script>
  <?php
if(isset($_FILES['photo']['name'])){
$iduser=isset($_POST['iduser'])?$_POST['iduser']:0;
$nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $erreur="";
    
//les photos doit d'extension png,jpg,jpeg,gif,svg,webp,tiff,bmp
 $extensions_valides = array( 'jpg' , 'jpeg', 'png' );
 $imageExtension=explode('.',$nomPhoto);
 $imageExtension= strtolower(end($imageExtension));
    if ( in_array($imageExtension,$extensions_valides) )
    {
        $imageTemp=$_FILES['photo']['tmp_name'];
        
          $requete="update utilisateur set photo=? where iduser=?";
          $params=array($nomPhoto,$iduser);
      
      $resultat=$pdo->prepare($requete);
      $resultat->execute($params);
        move_uploaded_file($imageTemp,"../images/".$nomPhoto);
        $erreur="non";
      header('location:my_profil.php?idUser='.$iduser);

    }
    else {
      $erreur="oui";
      echo "<script>alert('Invalid photo');
      document.location.href=my_profil.php?idUser='.$iduser;
      </script>";
    }
    
//if nomphoto est vide alors on ne modifie pas la photo else on modifie la photo

}
?>

<h6><?php echo $utilisateur['login']." ".$utilisateur['prenom'];?></h6>
<p><?php echo $utilisateur['role'];?></p>
</div>
<div class="card-body p-0">
<div class="profile-list">
<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
<a href="#">Email</a>
<a href="#" class="float-end"><h5><?php echo $utilisateur['email'];?></h5></a>
</div>
<div class="profile-list">
<a href="#"><i class="fe fe-phone"></i></a>
<a href="#">Call</a>
<a href="#" class="float-end"><h5>0668918732</h5></a>
</div>
<div class="profile-list">
<a href="#"><i class="fe fe-disabled"></i></a>
<a href="#">Blocked User</a>
<a href="#" class="float-end"><h5>103</h5></a>
</div>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card">
<div class="card-header">
 <h4 class="card-title">General Settings</h4>
</div>
<div class="card-body">
<form method='post' action='updateUtilisateur.php' class='form' enctype='multipart/form-data'>
<div class='form-group'>
<input type='hidden' name='iduser' class='form-control' value='<?php echo $id ?>'>
</div>
<div class='form-group'>
<label for='nom'>Nom :</label>
<input type='text' name='login' placeholder='Login' class='form-control' value="<?php echo $utilisateur['login'];?>">
</div>
<div class='form-group'>
<label for='prenom'>Prenom :</label>
<input type='text' name='prenom' placeholder='Prenom' class='form-control' value="<?php echo $utilisateur['prenom'];?>">
</div>
<div class='form-group'>
<label for='email'>Email :</label>
<input type='email' name='email' placeholder='email' class='form-control'
                                   value="<?php echo $utilisateur['email'];?>">
</div>
<div class='form-group'>
<label for='civilite'>Civilite :</label>
<select name='civilite' class='form-control'>
<option value='M'
   <?php if($utilisateur['civilite']=='M') echo 'selected';?> >Homme</option>

<option value='M'
   <?php if($utilisateur['civilite']=='F') echo 'selected';?>>Femme</option>
</select>
</div>
<div class='text-end'>
<button type='submit' class='btn btn-primary'>
<span class='glyphicon glyphicon-save'></span>
Enregistrer
</button>
<a href='editPwd.php'>Changer le mot de passe</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


<script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/js/script.js"></script>
</body>
</html>