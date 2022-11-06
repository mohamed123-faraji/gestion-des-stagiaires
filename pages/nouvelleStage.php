<?php 
    require_once('identifier.php');
    require_once("connexiondb.php");  
    //filieres
    $requete="select * from filiere";
    $resultat=$pdo->query($requete);
    //stagiaires
    $requeteStag="select idStagiaire,login,prenom,u.iduser from stagiaire st,utilisateur u where st.iduser=u.iduser";
    $resultatStag=$pdo->query($requeteStag);
    //encadrants
    $requeteEnc="select * from encadrants";
    $resultatEnc=$pdo->query($requeteEnc);
    //offres de stage
    $requete="select * from offre_stage";
    $resultatOffres=$pdo->query($requete);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Nouveau stage</title>

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
<li class="breadcrumb-item active">Nouveau stage</li>
</ul>
</div>
</div>
</div>
<div class="row ">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Veuillez saisir les données du nouveau Stage</h4>
</div>
<div class="card-body">
<form method="post" action="insertStage.php" class="form" enctype="multipart/form-data">
<div class="form-group row">
<label class="col-form-label col-md-2" for="idOffre">Offre</label>
<div class="col-md-10">
<select name="idOffre" class="form-control form-select" id="idOffre">
      <?php while($offre=$resultatOffres->fetch()) { ?>
    <option value="<?php echo $offre['idOffre']?>">
      <?php echo $offre['sujet_stage'] ?>
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
        <option value="<?php echo $stagiaire['idStagiaire']?>">
          <?php echo $stagiaire['login']." ".$stagiaire['prenom'] ?>
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
      <option value="<?php echo $encadrant['idEncadrant']?>">
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