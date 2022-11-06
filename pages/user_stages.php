<?php
    require_once('identifier.php');
    require_once("connexiondb.php");
    include('../les_fonctions/fonctions.php');
    $size=isset($_GET['size'])?$_GET['size']:6;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
   
    $requete="select st.idStagiaire,iduser,(select niveau from offre_stage ,filiere  where offre_stage.idFiliere=filiere.idFiliere and idOffre=s.idOffre) as niveau,(select nomFiliere from offre_stage ,filiere  where offre_stage.idFiliere=filiere.idFiliere and idOffre=s.idOffre) as nomFiliere,sujet_stage,date_debut,date_fin from stages s,stagiaire st,offre_stage o
    where s.idStagiaire=st.idStagiaire
    and s.idOffre=o.idOffre
    and date_fin<now()
    and st.iduser=".$_SESSION['user']['iduser'];
    
    $resultat=$pdo->query($requete);
    $nbr=$resultat->rowCount();
    ;
    $nbrStage=$nbr;
    $reste=$nbrStage % $size;   // % operateur modulo: le reste de la division 
                                 //euclidienne de $nbrFiliere par $size
    if($reste===0) //$nbrFiliere est un multiple de $size
        $nbrPage=$nbrStage/$size;   
    else
        $nbrPage=floor($nbrStage/$size)+1; 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion des stages</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<link rel="stylesheet" href="../assets/css/feathericon.min.css">

<link rel="stylesheet" href="../assets/plugins/morris/morris.css">

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/monstyle.css">

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
<h3 class="page-title">Votre stages</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>

</ul>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 d-flex">

<div class="card card-table flex-fill">
<div class="card-header">
<h4 class="card-title float-start">Liste des stages</h4>
<div class="table-search float-end">
<input type="text" class="form-control" placeholder="Search">
<button class="btn" type="submit"><i class="fa fa-search"></i></button>
</div>
</div>
<div class="card-body">
<div class="table-responsive no-radius">
<table class="table table-hover table-center">
<thead>
<tr>
<th>Filiere</th>
<th>Intitule de stage</th><th>Date De debut</th>
<th>Date De fin</th>
<?php if ($_SESSION['user']['role']== 'VISITEUR') {?>
 <th class="text-end">Actions</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php while($stage=$resultat->fetch()){ ?>
<tr>
<td class="text-nowrap">
<div class="font-weight-600"><?php echo $stage['nomFiliere'] ?></div>
</td>
<td class="text-nowrap">
<div class="font-weight-600"><?php echo $stage['sujet_stage'] ?> </div>
</td>
<td class="text-nowrap">
<div class="font-weight-600"><?php echo $stage['date_debut'] ?></div>
</td>
<td class="text-nowrap">
<div class="font-weight-600"><?php echo $stage['date_fin'] ?></div>
</td>
<?php if ($_SESSION['user']['role']== 'VISITEUR') {?>
<td class="text-end">
<div class="font-weight-600 text-danger">
<a 
   href="../fpdf/att_stage.php?idS=<?php echo $stage['idStagiaire'] ?>&db=<?php echo $stage['date_debut'];?>&df=<?php echo $stage['date_fin'];?>&nomF=<?php echo $stage['nomFiliere'];?>&niveau=<?php echo $stage['niveau'];?>&sj=<?php echo $stage['sujet_stage'];?>">
   <i class="fa fa-print" aria-hidden="true"></i>
</a>
</div>
</td>
<?php }?>
</tr>
<?PHP } ?>
</tbody>
</table>
<div class="ms-2">
<nav aria-label="...">
  <ul class="pagination pagination-sm">
  <?php for($i=1;$i<=$nbrPage;$i++){ ?>
    <li class="page-item <?php if($i==$page) echo 'active' ?>">
    <a href="user_stages.php?page=<?php echo $i;?>">
        <?php echo $i; ?>
     </a> 
    </li>
  <?php } ?>
  </ul>
</nav>
</div>
</div>
</div>
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