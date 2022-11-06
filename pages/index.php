<?php
     require_once('identifier.php');
     require_once("connexiondb.php");
     require_once('../les_fonctions/fonctions.php');
     
     //nbr de stagiaire et nbr de visiteur et nbr de stages
     $requeteS="select count(*) as nbrS from stagiaire";
     $result=$pdo->query($requeteS);
        $rows=$result->fetch();
        $nbrStagiaire=$rows['nbrS'];
        
        $requete="select count(*) as nbr from utilisateur";
        $result=$pdo->query($requete);
        $row=$result->fetch();
        $nbrUtilisateur=$row['nbr'];
        //nbr de stages
        $requete="select count(*) as nbr from offre_stage";
        $result=$pdo->query($requete);
        $row=$result->fetch();
        $nbrStage=$row['nbr'];



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Dashboard</title>

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
<div class="row">
<div class="col-xl-4 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-primary">
<i class="fe fe-users"></i>
</span>
<div class="dash-count">
<a href="#" class="count-title">utilisateur</a>
<a href="#" class="count"><?php echo $nbrUtilisateur; ?> </a>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-4 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-warning">
<span class="fa fa-user-plus"></span>
</span>
<div class="dash-count">
<a href="#" class="count-title">Stagiaire</a>
<a href="#" class="count"><?php echo $rows['nbrS']; ?></a>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-4 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-danger">
<i class="fa fa-vcard"></i>
</span>
<div class="dash-count">
<a href="#" class="count-title">Offre de Stage</a>
<a href="#" class="count"><?php echo $nbrStage;?></a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
         <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="welcome-user">
                           <span>Bienvenue</span>
                           <h3 class="mb-0"><?php echo $_SESSION['user']['login']." ".$_SESSION['user']['prenom']; ?></h3>
                     </div>
                     <div class="welcome-msg">
                           <p>Vous pouvez consulter les offres de stages en cliquant sur le bouton ci-dessous</p>
                           <a href="offres.php" class="btn btn-primary">Consulter les offres</a>
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