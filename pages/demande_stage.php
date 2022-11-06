<?php
    require_once('identifier.php');
    require_once("connexiondb.php");
    
    
    $nomo=isset($_GET['nomO'])?$_GET['nomO']:"";
    //$idfiliere=isset($_GET['idFiliere'])?$_GET['idFiliere']:0;
    //recuperer tous les filiers
    $requete="select distinct * from filiere";
    $resultat=$pdo->query($requete);
    
    $size=isset($_GET['size'])?$_GET['size']:6;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    

        
            $requete="select distinct idDemande,idOffre,login,email,prenom
            from demande_stage d,utilisateur u
            where d.idUser=u.iduser
            order by idOffre 
            limit $size
            offset $offset";
            
            $requeteCount="select count(*) countS from offre_stage
                    where sujet_stage like '%$nomo%'";
                    
        
       
    

    $resultatS=$pdo->query($requete);

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrDemande=$resultatS->rowCount();
    $reste=$nbrDemande % $size;   // % operateur modulo: le reste de la division 
                                 //euclidienne de $nbrFiliere par $size
    if($reste===0) //$nbrFiliere est un multiple de $size
        $nbrPage=$nbrDemande/$size;   
    else
        $nbrPage=floor($nbrDemande/$size)+1;  // floor : la partie entière d'un nombre décimal
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion des demandes</title>

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
<h3 class="page-title">Demande de stage</h3>
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
<h4 class="card-title float-start">Liste des demandes</h4>
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
<th>Id demande</th><th>Id offre</th><th>NomUtilisateur</th><th>Email</th>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
 <th class="text-end">Actions</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php while($demande=$resultatS->fetch()){ ?>
<tr>
<td class="text-nowrap">
<div class="font-weight-600"><?php echo $demande['idDemande'] ?> </div>
</td>
<td class="text-nowrap">
<div class="font-weight-600"><?php echo $demande['idOffre'] ?></div>
</td>
<td class="text-nowrap"><?php echo $demande['login']." ".$demande['prenom'] ?></td>
<td class="text-nowrap"><?php echo $demande['email'] ?></td>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<td class="text-end">
<div class="font-weight-600 text-danger">
<a href="accepterdemande.php?idD=<?php echo $demande['idDemande'] ?>&email=<?php echo $demande['email'] ?>">
   <i class="fa fa-check" aria-hidden="true"></i>
    </a>
    &nbsp;
    <a onclick="return confirm('Etes vous sur de vouloir refuser la demande')"
        href="supprimerDemande.php?idD=<?php echo $demande['idDemande'] ?>">
    <span class="glyphicon glyphicon-trash"></span>
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
    <a href="demande_stage.php?page=<?php echo $i;?>">
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