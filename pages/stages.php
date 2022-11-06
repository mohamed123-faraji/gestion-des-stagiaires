<?php
    require_once('identifier.php');
    require_once("connexiondb.php");
    
    /*
    if(isset($_GET['nomF']))
        $nomf=$_GET['nomF'];
    else
        $nomf="";
    */
  
    $noms=isset($_GET['nomS'])?$_GET['nomS']:"";
    $idfiliere=isset($_GET['idFiliere'])?$_GET['idFiliere']:0;
    //recuperer tous les filiers
    $requete="select distinct * from filiere";
    $resultat=$pdo->query($requete);
    
    $size=isset($_GET['size'])?$_GET['size']:6;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
    if($idfiliere==0){
        
            $requete="select distinct idStage,st.idStagiaire,o.idFiliere,en.idEncadrant,sujet_stage,date_debut,date_fin,(select nomFiliere from filiere,offre_stage where filiere.idFiliere=offre_stage.idFiliere and idOffre=s.idOffre) as nomFiliere,
            en.nom nomEncadrant from stages s,
            filiere f,stagiaire st,encadrants en ,offre_stage o
            where s.idStagiaire=st.idStagiaire
            and s.idEncadrant=en.idEncadrant 
            and s.idOffre=o.idOffre
            and  (o.sujet_stage like '%$noms%')
            order by idStage 
            limit $size
            offset $offset";
            
            $requeteCount="select count(*) countS from stages,offre_stage where stages.idOffre=offre_stage.idOffre and (offre_stage.sujet_stage like '%$noms%')";
                    
        
       
    }else{
        
         $requete="select distinct idStage,s.idStagiaire,o.idFiliere,s.idEncadrant,sujet_stage,date_debut,date_fin,(select nomFiliere from filiere,offre_stage where filiere.idFiliere=offre_stage.idFiliere and idOffre=s.idOffre) as nomFiliere,
         en.nom nomEncadrant from stages s,
         filiere f,stagiaire st,encadrants en,offre_stage o
               where s.idStagiaire=st.idStagiaire
                and s.idEncadrant=en.idEncadrant 
                and s.idOffre=o.idOffre
                and  (sujet_stage like '%$noms%')
                and o.idFiliere='$idfiliere'
                limit $size
                offset $offset";
        
        $requeteCount="select count(*) countS from stages,offre_stage where stages.idOffre=offre_stage.idOffre and (offre_stage.sujet_stage like '%$noms%') and idFiliere='$idfiliere'";
                
        
      
    }

    $resultatS=$pdo->query($requete);

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrStage=$tabCount['countS'];
    $reste=$nbrStage % $size;   // % operateur modulo: le reste de la division 
                                 //euclidienne de $nbrFiliere par $size
    if($reste===0) //$nbrFiliere est un multiple de $size
        $nbrPage=$nbrStage/$size;   
    else
        $nbrPage=floor($nbrStage/$size)+1;  // floor : la partie entière d'un nombre décimal
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
<h3 class="page-title">Stages</h3>
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
<div class="panel-heading">Rechercher des stages</div>
				
				<div class="panel-body">
					<form method="get" action="stages.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomS" 
                                   placeholder="Sujet de stage"
                                   class="form-control"
                                   value="<?php echo $noms ?>"/>
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
                         <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                         
                            <a href="nouvelleStage.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouveau stage
                                
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
    <th>IdStage</th>
    <th>IdStagiaire</th>
    <th>Encadrant</th>
    <th>Filiere</th>
    <th>Intitule de stage</th>
    <th>Date De debut</th>
    <th>Date De fin</th>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<th class="text-end">Action</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php while($stage=$resultatS->fetch()){ ?>
<tr>
    <td><?php echo $stage['idStage'] ?> </td>
    <td><?php echo $stage['idStagiaire'] ?> </td>
    <td><?php echo $stage['nomEncadrant'] ?> </td>
                               
    <td><?php echo $stage['nomFiliere'] ?> </td>
    <td><?php echo $stage['sujet_stage'] ?> </td> 
    <td><?php echo $stage['date_debut'] ?> </td>
    <td><?php echo $stage['date_fin'] ?> </td>
<?php if ($_SESSION['user']['role']== 'ADMIN') {?>
<td class="text-end">
<div class="actions">
<a href="editerStage.php?idS=<?php echo $stage['idStage'] ?>" class="btn btn-sm bg-success-light me-2">
<i class="fe fe-pencil"></i>
</a>
<a onclick="return confirm('Etes vous sur de vouloir supprimer le stage')" href="supprimerStage.php?idSt=<?php echo $stage['idStage'] ?>" class="btn btn-sm bg-danger-light">
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
    <a href="stages.php?page=<?php echo $i;?>&nomS=<?php echo $nomf ?>&idFiliere=<?php echo $idfiliere ?>">
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