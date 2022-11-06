<?php
    require_once('identifier.php');
    
    require_once("connexiondb.php");
  
    $nomPrenom=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idetablissement=isset($_GET['idetablissement'])?$_GET['idetablissement']:0;
    
    $size=isset($_GET['size'])?$_GET['size']:5;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
    $requeteEtablissement="select * from etablissements";

    if($idetablissement==0){
        $requeteStagiaire="select distinct idStagiaire,s.iduser,nomEtablissement,photo,login,prenom,civilite
                from etablissements as f,stagiaire as s,utilisateur as u
                where f.idEtablissement=s.idEtablissement and s.iduser=u.iduser 
                and (u.login like '%$nomPrenom%' or u.prenom like '%$nomPrenom%')
                order by idStagiaire
                limit $size
                offset $offset";
        
        $requeteCount="select distinct count(*) countS from stagiaire,utilisateur
                where login like '%$nomPrenom%' or prenom like '%$nomPrenom%'
                and stagiaire.iduser=utilisateur.iduser";

               
    }else{
         $requeteStagiaire="select distinct idStagiaire,s.iduser,login,prenom,nomEtablissement,photo,civilite 
                from etablissements as f,stagiaire as s,utilisateur as u
                where f.idEtablissement=s.idEtablissement and s.iduser=u.iduser
                and (login like '%$nomPrenom%' or prenom like '%$nomPrenom%')
                and f.idEtablissement=$idetablissement
                 order by idStagiaire
                limit $size
                offset $offset";
        
        $requeteCount="select distinct count(*) countS from stagiaire,utilisateur
                where login like '%$nomPrenom%' or prenom like '%$nomPrenom%'
                and stagiaire.iduser=utilisateur.iduser
                and idEtablissement=$idetablissement";
    }

    $resultatEtablissement=$pdo->query($requeteEtablissement);
    $resultatStagiaire=$pdo->query($requeteStagiaire);
    $resultatCount=$pdo->query($requeteCount);

    $tabCount=$resultatCount->fetch();
    $nbrStagiaire=$tabCount['countS'];
    $reste=$nbrStagiaire % $size;   
    if($reste===0) 
        $nbrPage=$nbrStagiaire/$size;   
    else
        $nbrPage=floor($nbrStagiaire/$size)+1;  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion des stagiaires</title>

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
<h3 class="page-title">Stagiaires</h3>
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
<div class="panel-heading">Rechercher des stagiaires</div>
				
				<div class="panel-body">
					<form method="get" action="stagiaire.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomPrenom" 
                                   placeholder="Nom et prénom"
                                   class="form-control"
                                   value="<?php echo $nomPrenom ?>"/>
                        </div>
                            <label for="idetablissement">Etablissement:</label>
                            
				            <select name="idetablissement" class="form-control" id="idetablissement"
                                    onchange="this.form.submit()">
                                    
                                      
                                    <option value=0>Toutes les Etablissements</option>
                                    
                                <?php while ($etablissement=$resultatEtablissement->fetch()) { ?>
                                
                                    <option value="<?php echo $etablissement['idEtablissement'] ?>"
                                    
                                        <?php if($etablissement['idEtablissement']===$idetablissement) echo "selected" ?>>
                                        
                                        <?php echo $etablissement['nomEtablissement'] ?> 
                                        
                                    </option>
                                    
                                <?php } ?>
                                
				            </select>
				            
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;
                         <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                         
                            <a href="nouveauStagiaire.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouveau Stagiaire
                                
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
<th>Stagiaire</th><th>Nom</th> <th>Prénom</th> <th>Etablissement</th>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<th class="text-end">Action</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php while($stagiaire=$resultatStagiaire->fetch()){ ?>
<tr>
<td>
<h2 class="table-avatar">
<a href="my_profil.php?idUser=<?php echo $stagiaire['iduser'] ?>" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="../images/<?php echo $stagiaire['photo']?>" alt=""></a>
<a href=""><?php echo $stagiaire['login']." ". $stagiaire['prenom'] ?> <span>#<?php echo $stagiaire['idStagiaire'] ?></span></a>
</h2>
</td>
<td><?php echo $stagiaire['login'] ?> </td>
<td><?php echo $stagiaire['prenom'] ?> </td>
<td><?php echo $stagiaire['nomEtablissement'] ?></td>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<td class="text-end">
<div class="actions">
<a href="editerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>" class="btn btn-sm bg-success-light me-2">
<i class="fe fe-pencil"></i>
</a>
<a onclick="return confirm('Etes vous sur de vouloir supprimer le stagiaire')" href="supprimerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>" class="btn btn-sm bg-danger-light">
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
    <a href="stagiaire.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idetablissement=<?php echo $idetablissement ?>">
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