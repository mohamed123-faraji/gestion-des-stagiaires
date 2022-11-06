<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $ido=isset($_GET['idO'])?$_GET['idO']:0;
    $requeste="select * from offre_stage where idOffre=$ido";
    $resultat=$pdo->query($requeste);
    $offre=$resultat->fetch();
    
   
    $idFiliere=$offre['idFiliere'];
    $sujet=$offre['sujet_stage'];
    $dateD=$offre['date_debut'];
    $dateF=$offre['date_fin'];

    $requete="select * from filiere";
    $resultat=$pdo->query($requete);
    //stagiaires
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Edition d'un offre</title>

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
<h3 class="page-title">Paramètres de l'offre</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active">Edition d'un offre</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Edition d'un offre</h4>
</div>
<div class="card-body">
<form method="post" action="updateOffre.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<label class="col-form-label col-md-2" for="idO">Id du offre</label>
<div class="col-md-10">
<input type="hidden" name="idO" class="form-control" value="<?php echo $ido ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="sujet_stage">Sujet de stage</label>
<div class="col-md-10">
<input type="text" name="sujet_stage" class="form-control" placeholder="sujet de stage" value="<?php echo $sujet ?>"/>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="date_debut">Date de debut</label>
<div class="col-md-10">
<input type="date" value="<?php echo $dateD ?>" name="date_debut" placeholder="date de debut" class="form-control" />
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="date_fin">Date de fin</label>
<div class="col-md-10">
<input type="date" value="<?php echo $dateF ?>" name="date_fin" placeholder="date de fin" class="form-control" />
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="idFiliere">Filiere</label>
<div class="col-md-10">
<select name="idFiliere" class="form-control" id="idFiliere">
   <?php while($filiere=$resultat->fetch()) { ?>
    <option value="<?php echo $filiere['idFiliere']?>" <?php
        if($idFiliere===$filiere['idFiliere']) echo "selected" ?>>
        <?php echo $filiere['nomFiliere'] ?>
    </option>
  <?php }?>
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