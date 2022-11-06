<?php
     require_once('identifier.php');
     require_once('connexiondb.php');
     $idEn=isset($_GET['idEn'])?$_GET['idEn']:0;
    $requeteEn="select * from encadrants where idEncadrant=$idEn";                       
     $resultatEn=$pdo->query($requeteEn);
     $encadrant=$resultatEn->fetch();
     $nom=$encadrant['nom'];
     $prenom=$encadrant['prenom'];
     $adresse=$encadrant['adresse'];
     $tel=$encadrant['telephone'];
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Edition d'un Encadrant</title>

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
<h3 class="page-title">Encadrant Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active">Edition du Encadrant</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Edition du Encadrant</h4>
</div>
<div class="card-body">
<form method="post" action="updateEncadrant.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<div class="col-md-10">
<input type="hidden" name="idEn" class="form-control" value="<?php echo $idEn ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="nom">Nom</label>
<div class="col-md-10">
<input type="text" name="nom" placeholder="nom" class="form-control" value="<?php echo $nom ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="prenom">Prenom</label>
<div class="col-md-10">
<input type="text" name="prenom" placeholder="Prénom" class="form-control" value="<?php echo $prenom ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="adresse">Adresse</label>
<div class="col-md-10">
<input type="text" name="adresse" placeholder="Adresse" class="form-control" value="<?php echo $adresse ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="telephone">Telephone</label>
<div class="col-md-10">
<input type="text" name="telephone" placeholder="Telephone" class="form-control" value="<?php echo $tel ?>"/>
</div>
</div>
<div class="text-end">
<button type="submit" class="btn btn-primary">Enregistrer</button>
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