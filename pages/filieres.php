<?php
     require_once('identifier.php');
     require_once("connexiondb.php");
     
     /*
     if(isset($_GET['nomF']))
         $nomf=$_GET['nomF'];
     else
         $nomf="";
     */
   
     $nomf=isset($_GET['nomF'])?$_GET['nomF']:"";
     $niveau=isset($_GET['niveau'])?$_GET['niveau']:"all";
     
     $size=isset($_GET['size'])?$_GET['size']:6;
     $page=isset($_GET['page'])?$_GET['page']:1;
     $offset=($page-1)*$size;
     
     if($niveau=="all"){
         $requete="select * from filiere
                 where nomFiliere like '%$nomf%'
                 limit $size
                 offset $offset";
         
         $requeteCount="select count(*) countF from filiere
                 where nomFiliere like '%$nomf%'";
     }else{
          $requete="select * from filiere
                 where nomFiliere like '%$nomf%'
                 and niveau='$niveau'
                 limit $size
                 offset $offset";
         
         $requeteCount="select count(*) countF from filiere
                 where nomFiliere like '%$nomf%'
                 and niveau='$niveau'";
     }
 
     $resultatF=$pdo->query($requete);
 
     $resultatCount=$pdo->query($requeteCount);
     $tabCount=$resultatCount->fetch();
     $nbrFiliere=$tabCount['countF'];
     $reste=$nbrFiliere % $size;   // % operateur modulo: le reste de la division 
                                  //euclidienne de $nbrFiliere par $size
     if($reste===0) //$nbrFiliere est un multiple de $size
         $nbrPage=$nbrFiliere/$size;   
     else
         $nbrPage=floor($nbrFiliere/$size)+1; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion des filières</title>

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
<h3 class="page-title">Filières</h3>
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
<div class="panel-heading">Rechercher des filières</div>
				
				<div class="panel-body">
					<form method="get" action="filieres.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomF" 
                                   placeholder="Nom de la filière"
                                   class="form-control"
                                   value="<?php echo $nomf ?>"/>
                        </div>
                            <label for="niveau">Niveau:</label>
                            
				            <select name="niveau" class="form-control" id="niveau"
                                    onchange="this.form.submit()">
                                    <option value="all" <?php if($niveau==="all") echo "selected" ?>>Tous les niveaux</option>
                                    <option value="q"   <?php if($niveau==="q")   echo "selected" ?>>Qualification</option>
                                    <option value="t"   <?php if($niveau==="t")   echo "selected" ?>>Technicien</option>
                                    <option value="ts"  <?php if($niveau==="ts")  echo "selected" ?>>Technicien Spécialisé</option>
                                    <option value="l"   <?php if($niveau==="l")   echo "selected" ?>>Licence</option>
                                    <option value="m"   <?php if($niveau==="m")   echo "selected" ?>>Master</option> 
				            </select>
				            
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;
                         <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                         
                            <a href="nouvelleFiliere.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouvelle filière
                                
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
<th>Id filière</th><th>Nom filière</th><th>Niveau</th>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<th class="text-end">Action</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php while($filiere=$resultatF->fetch()){ ?>
<tr>
<td><?php echo $filiere['idFiliere'] ?> </td>
<td><?php echo $filiere['nomFiliere'] ?> </td>
<td><?php echo $filiere['niveau'] ?> </td> 
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<td class="text-end">
<div class="actions">
<a href="editerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>" class="btn btn-sm bg-success-light me-2">
<i class="fe fe-pencil"></i>
</a>
<a onclick="return confirm('Etes vous sur de vouloir supprimer la filière')" href="supprimerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>" class="btn btn-sm bg-danger-light">
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
    <a class="filieres.php?page=<?php echo $i;?>&nomF=<?php echo $nomf ?>&niveau=<?php echo $niveau ?>">
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