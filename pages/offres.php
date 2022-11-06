
<?php
require_once('identifier.php');
require_once("connexiondb.php");

$nomo=isset($_GET['nomO'])?$_GET['nomO']:"";
$idfiliere=isset($_GET['idFiliere'])?$_GET['idFiliere']:0;
//recuperer tous les filiers
$requete="select distinct * from filiere";
$resultat=$pdo->query($requete);

$size=isset($_GET['size'])?$_GET['size']:3;
$page=isset($_GET['page'])?$_GET['page']:1;
$offset=($page-1)*$size;

if($idfiliere==0){
    
        $requete="select idOffre,sujet_stage,date_debut,date_fin,nomFiliere
        from offre_stage o,filiere f
        where o.idFiliere=f.idFiliere
        and  (sujet_stage like '%$nomo%')";
        if($_SESSION['user']['role']=="VISITEUR")
        {
            $requete.="and date_debut >= now()";
        }
        $requete.="order by idOffre 
        limit $size
        offset $offset";
        
        $requeteCount="select count(*) countS from offre_stage
                where sujet_stage like '%$nomo%'";
                if($_SESSION['user']['role']=="VISITEUR")
        {
            $requeteCount.="and date_debut >= now()";
        }
                
    }
    else{
        $requete="select idOffre,sujet_stage,date_debut,date_fin,nomFiliere
        from offre_stage o,filiere f
        where o.idFiliere=f.idFiliere
        and (sujet_stage like '%$nomo%')
        and o.idFiliere='$idfiliere'";
        if($_SESSION['user']['role']=="VISITEUR")
        {
            $requete.="and date_debut >= now()";
        }
        $requete.="order by idOffre 
        limit $size
        offset $offset";
        
        $requeteCount="select count(*) countS from offre_stage
                where sujet_stage like '%$nomo%'
                and idFiliere='$idfiliere'";
                if($_SESSION['user']['role']=="VISITEUR")
        {
            $requeteCount.="and date_debut >= now()";
        }
    }
   


$resultatS=$pdo->query($requete);

$resultatCount=$pdo->query($requeteCount);
$tabCount=$resultatCount->fetch();
$nbrOffre=$tabCount['countS'];
$reste=$nbrOffre % $size;   // % operateur modulo: le reste de la division 
                             //euclidienne de $nbrFiliere par $size
if($reste===0) //$nbrFiliere est un multiple de $size
    $nbrPage=$nbrOffre/$size;   
else
    $nbrPage=floor($nbrOffre/$size)+1;  // floor : la partie entière d'un nombre décimal
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion des Offre</title>

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
<h3 class="page-title">Offres</h3>
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
<div class="panel-heading">Rechercher des offres</div>
				
				<div class="panel-body">
					<form method="get" action="offres.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomO" 
                                   placeholder="Sujet de stage"
                                   class="form-control"
                                   value="<?php echo $nomo ?>"/>
                        </div>
                            <label for="idFiliere">Filiere:</label>
                            
				            <select name="idFiliere" class="form-control" id="idFiliere"
                            onchange="this.form.submit()">
                                <option value=0>Toutes les filières</option>
                                <?php while ($filiere=$resultat->fetch()) { ?>
                                
                                <option value="<?php echo $filiere['idFiliere'] ?>"
                                
                                    <?php if($filiere['idFiliere']===$idfiliere) echo "selected" ?>>
                                    
                                    <?php echo $filiere['nomFiliere'] ?> 
                                    
                                </option>
                                
                            <?php } ?>
			            </select>
				            
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;
                        <?php if ($_SESSION['user']['role']=='ADMIN') {?>
                       	
                           <a href="nouvelleOffre.php">
                           
                               <span class="glyphicon glyphicon-plus"></span>
                               
                               Nouvelle Offre
                               
                           </a>
                           
                       <?php } ?> 
					</form>
				</div>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<?php while($offre=$resultatS->fetch()){ ?>
                <div class="card">
                <h5 class="card-header">Stage en  <?php echo $offre['nomFiliere'] ?> a partir de <?php echo $offre['date_debut']   ?></h5>
                <div class="card-body">
                    <h5 class="card-title">APTUS Consulting Casablanca</h5>
                    <p class="card-text"> <?php echo $offre['sujet_stage'] ?>.</p>
                    <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                            <a  href="editerOffre.php?idO=<?php echo $offre['idOffre'] ?>">
                                     <span class="glyphicon glyphicon-edit"></span>
                             </a>
                                            &nbsp;
                             <a onclick="return confirm('Etes vous sur de vouloir supprimer offre')"
                                                href="supprimerOffre.php?idO=<?php echo $offre['idOffre'] ?>">
                                     <span class="glyphicon glyphicon-trash"></span>
                            </a>
                       <?php } ?>
                       <?php if ($_SESSION['user']['role']== 'VISITEUR') {?>
                                        
                            <a href="postuler.php?idO=<?php echo $offre['idOffre'] ?>">
                                   <span ><i class="fa fa-plus" aria-hidden="true"></i>Postuler</span>
                            </a>
                     <?php } ?>
                </div>
            </div>
        <?php } ?>
</table>
<div class="ms-2">
<nav aria-label="...">
  <ul class="pagination pagination-sm">
  <?php for($i=1;$i<=$nbrPage;$i++){ ?>
    <li class="page-item <?php if($i==$page) echo 'active' ?>">
    <a href="offres.php?page=<?php echo $i;?>&nomO=<?php echo $nomo ?>&idFiliere=<?php echo $idfiliere ?>">
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