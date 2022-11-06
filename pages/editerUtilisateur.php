<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
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
<title>Edition d'un utilisateur</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

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
<h3 class="page-title">User Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active">Edition de l'utilisateur</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Edition de l'utilisateur</h4>
</div>
<div class="card-body">
<form method="post" action="updateUtilisateur.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<input type="hidden" name="iduser" class="form-control" value="<?php echo $id ?>"/>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="nom">Login</label>
<div class="col-md-10">
<input type="text" name="login" placeholder="Login" class="form-control" value="<?php echo $login ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="prenom">Prenom</label>
<div class="col-md-10">
<input type="text" name="prenom" placeholder="Prenom" class="form-control" value="<?php echo $utilisateur['prenom'] ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="email">Email</label>
<div class="col-md-10">
<input type="email" name="email" placeholder="email" class="form-control" value="<?php echo $email ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="civilite">Civilite</label>
<div class="col-md-10">
    <select name="civilite" class="form-control">
         <option value="M" <?php if($utilisateur['civilite']=="M") echo "selected"; ?>>Homme</option>
         <option value="F" <?php if($utilisateur['civilite']=="F") echo "selected"; ?>>Femme</option>
    </select>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="photo">Photo</label>
<div class="col-md-10">
<input class="form-control" type="file" name="photo">
</div>
</div>

<div class="text-end">
<button type="submit" class="btn btn-primary">Enregistrer</button>
<a href="editPwd.php">Changer le mot de passe</a> 
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