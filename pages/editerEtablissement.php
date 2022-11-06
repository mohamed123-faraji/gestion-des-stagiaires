<?php
   require_once('identifier.php');
    require_once('connexiondb.php');
    $ide=isset($_GET['idE'])?$_GET['idE']:0;
    $requete="select * from etablissements where idEtablissement=$ide";
    $resultat=$pdo->query($requete);
    $etablissement=$resultat->fetch();
    $nome=$etablissement['nomEtablissement'];
    $adresse=$etablissement['adresse'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Edition d'un etablissement</title>

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
<h3 class="page-title">Etablissement Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active">Edition de l'etablissement</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Edition de l'etablissement</h4>
</div>
<div class="card-body">
<form method="post" action="updateEtablissement.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<label class="col-form-label col-md-2" for="idE">Id de l'etablissement</label>
<div class="col-md-10">
<input type="hidden" name="idE" class="form-control" value="<?php echo $ide ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="nomE">Nom de l'etablissement</label>
<div class="col-md-10">
<input type="text" name="nomE" class="form-control" placeholder="Nom de l'etablissement" value="<?php echo $nome ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="adresse">L'adresse</label>
<div class="col-md-10">
<input type="text" name="adresse" class="form-control" placeholder="Adresse de l'etablissement" value="<?php echo $adresse ?>"/>
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