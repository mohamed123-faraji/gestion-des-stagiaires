<?php
 require_once('identifier.php');
 require_once('connexiondb.php');
 $idf=isset($_GET['idF'])?$_GET['idF']:0;
 $requete="select * from filiere where idFiliere=$idf";
 $resultat=$pdo->query($requete);
 $filiere=$resultat->fetch();
 $nomf=$filiere['nomFiliere'];
 $niveau=strtolower($filiere['niveau']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Edition d'une filière</title>

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
<h3 class="page-title">Filière Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active">Edition d'une filière</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Edition d'une filière</h4>
</div>
<div class="card-body">
<form method="post" action="updateFiliere.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<label class="col-form-label col-md-2" for="idF">Id de la filière</label>
<div class="col-md-10">
<input type="hidden" name="idF" class="form-control" value="<?php echo $idf ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="nomF">Nom de la filière</label>
<div class="col-md-10">
<input type="text" name="nomF" class="form-control" placeholder="Nom de la filière" value="<?php echo $nomf ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="niveau">Niveau</label>
<div class="col-md-10">
<select name="niveau" class="form-control form-select" id="niveau">
  <option value="qualification" <?php if($niveau=="q" || $niveau=="qualification") echo "selected" ?>>Qualification</option>
  <option value="technicien" <?php if($niveau=="t" || $niveau=="technicien") echo "selected" ?>>Technicien</option>
  <option value="technicien spécialisé" <?php if($niveau=="ts" || $niveau=="technicien spécialisé") echo "selected" ?>>Technicien Spécialisé</option>
  <option value="licence" <?php if($niveau=="l" || $niveau=="licence") echo "selected" ?>>Licence</option>
  <option value="master" <?php if($niveau=="m" || $niveau=="master") echo "selected" ?>>Master</option> 
</select>
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