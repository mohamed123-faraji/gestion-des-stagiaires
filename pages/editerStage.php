<?php
  require_once('identifier.php');
  require_once('connexiondb.php');
  $idSt=isset($_GET['idS'])?$_GET['idS']:0;
  $requeteSt="select s.idOffre,idStagiaire,idEncadrant,idFiliere,sujet_stage,date_debut,date_fin from stages s,offre_stage where s.idOffre=offre_stage.idOffre and idStage=$idSt";
  
  $resultatSt=$pdo->query($requeteSt);
  $stage=$resultatSt->fetch();
  $idStagiaire=$stage['idStagiaire'];
  $idFiliere=$stage['idFiliere'];
  $idEncadrant=$stage['idEncadrant'];
  $idOffre=$stage['idOffre'];
  

  $requete="select * from filiere";
  $resultat=$pdo->query($requete);
  //stagiaires
  $requeteStag="select login,prenom,idStagiaire from stagiaire,utilisateur where utilisateur.iduser=stagiaire.iduser";
  $resultatStag=$pdo->query($requeteStag);
  //encadrants
  $requeteEnc="select * from encadrants";
  $resultatEnc=$pdo->query($requeteEnc);
  //select * from offre_stage;
  $requeteOffre="select * from offre_stage";
  $resultatOffre=$pdo->query($requeteOffre);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Edition d'un stage</title>

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
<h3 class="page-title">Stage Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active">Edition d'un stage</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Edition d'un stage</h4>
</div>
<div class="card-body">
<form method="post" action="updateStage.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<input type="hidden" name="idSt" class="form-control" value="<?php echo $idSt ?>"/>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="idOffre">Offre</label>
<div class="col-md-10">
<select name="idOffre" class="form-control form-select" id="idOffre">
    <?php while($offre=$resultatOffre->fetch()) { ?>
    <option value="<?php echo $offre['idOffre']?>" 
       <?php if($idOffre===$offre['idOffre']) echo "selected" ?>>
       <?php echo $offre['sujet_stage'];?>
    </option>
       <?php }?>
</select>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="idStagiaire">Stagiaire</label>
<div class="col-md-10">
<select name="idStagiaire" class="form-control form-select" id="idStagiaire">
<?php while($stagiaire=$resultatStag->fetch()) { ?>
   <option value="<?php echo $stagiaire['idStagiaire']?>" 
      <?php if($idStagiaire===$stagiaire['idStagiaire']) echo "selected" ?>>
      <?php echo $stagiaire['login']." ". $stagiaire['prenom'] ;?>
    </option>
 <?php }?>
	</select>
</div>
</div>
<div class="form-group row">
<label class="col-form-label col-md-2" for="idEncadrant">Encadrant</label>
<div class="col-md-10">
<select name="idEncadrant" class="form-control form-select" id="idEncadrant">
<?php while($encadrant=$resultatEnc->fetch()) { ?>
    <option value="<?php echo $encadrant['idEncadrant']?>"
       <?php if($idEncadrant===$encadrant['idEncadrant']) echo "selected" ?>>
       <?php echo $encadrant['nom'] ?>
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