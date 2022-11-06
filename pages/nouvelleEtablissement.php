<?php
require_once('identifier.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Nouvelle Etablissement</title>

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
<li class="breadcrumb-item active">Nouvelle Etablissement</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Veuillez saisir les données de la nouvelle Etablissement</h4>
</div>
<div class="card-body">
<form method="post" action="insertEtablissement.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<label class="col-form-label col-md-2" for="nomE">Nom de l'etablissement</label>
<div class="col-md-10">
<input type="text" name="nomE" placeholder="Nom de l'etablissement" class="form-control" />
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="adresse">L'adresse</label>
<div class="col-md-10">
<input type="text" name="adresse" placeholder="Adresse de l'etablissement" class="form-control" />
</div>
</div>
<div class="text-end">
<button type="submit" class="btn btn-primary">Enregistrer</button>
</div>
</form>
<?php
  if(isset($_GET['msg'])){
   echo '<div class="alert alert-danger">' . $_GET['msg'] . '</div>';
  }
 ?>
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