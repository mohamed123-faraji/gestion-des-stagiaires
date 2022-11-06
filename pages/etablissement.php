<?php
    require_once('identifier.php');
    require_once("connexiondb.php");
    
    $nomE=isset($_GET['nomE'])?$_GET['nomE']:"";
    
    
    $size=isset($_GET['size'])?$_GET['size']:6;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
     $requete="select * from etablissements
                where nomEtablissement like '%$nomE%'
                limit $size
                offset $offset";
        
    $requeteCount="select count(*) countE from etablissements
                where nomEtablissement like '%$nomE%'
                ";

    $resultatE=$pdo->query($requete);

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrEtablissement=$tabCount['countE'];
    $reste=$nbrEtablissement % $size;   // % operateur modulo: le reste de la division 
                                 //euclidienne de $nbrFiliere par $size
    if($reste===0) //$nbrFiliere est un multiple de $size
        $nbrPage=$nbrEtablissement/$size;   
    else
        $nbrPage=floor($nbrEtablissement/$size)+1;  // floor : la partie entière d'un nombre décimal
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion des Etablissements</title>

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
<h3 class="page-title">Etablissements</h3>
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
<div class="panel-heading">Rechercher des etablissements</div>
				
				<div class="panel-body">
					<form method="get" action="etablissement.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomE" 
                                   placeholder="Nom de l'etablissement"
                                   class="form-control"
                                   value="<?php echo $nomE ?>"/>
                        </div>
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;
                         <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                         
                            <a href="nouvelleEtablissement.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouvelle etablissement
                                
                            </a>
                            
                         <?php }?>
					</form>
				</div>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<thead>
<tr>
<th>Id Etablissement</th><th>Nom etablissement</th><th>Adresse</th>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<th class="text-end">Action</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php while($etablissement=$resultatE->fetch()){ ?>
<tr>
<td><?php echo $etablissement['idEtablissement'] ?> </td>
<td><?php echo $etablissement['nomEtablissement'] ?> </td>
<td><?php echo $etablissement['adresse'] ?> </td> 
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<td class="text-end">
<div class="actions">
<a href="editerEtablissement.php?idE=<?php echo $etablissement['idEtablissement'] ?>" class="btn btn-sm bg-success-light me-2">
<i class="fe fe-pencil"></i>
</a>
<a onclick="return confirm('Etes vous sur de vouloir supprimer etablissement')"
 href="supprimerEtablissement.php?idE=<?php echo $etablissement['idEtablissement'] ?>" class="btn btn-sm bg-danger-light">
<i class="fe fe-trash"></i>
 </a>
</div>
</td>
<?php }?>
</tr>
<?php } ?>
</tbody>
</table>
<div class="ms-2">
<nav aria-label="...">
  <ul class="pagination pagination-sm">
  <?php for($i=1;$i<=$nbrPage;$i++){ ?>
    <li class="page-item <?php if($i==$page) echo 'active' ?>">
    <a class="etablissement.php?page=<?php echo $i;?>&nomE=<?php echo $nomE ?>">
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


<script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/js/script.js"></script>
</body>
</html>