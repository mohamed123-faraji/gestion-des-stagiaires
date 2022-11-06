<?php
    require_once('role.php');
    require_once("connexiondb.php");
    $login=isset($_GET['login'])?$_GET['login']:"";
    
    $size=isset($_GET['size'])?$_GET['size']:3;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
   
    $requeteUser="select * from utilisateur  where login like '%$login%' limit $size
    offset $offset";
    $requeteCount="select count(*) countUser from utilisateur where login like '%$login%'";
   
    $resultatUser=$pdo->query($requeteUser);
    $resultatCount=$pdo->query($requeteCount);

    $tabCount=$resultatCount->fetch();
    $nbrUser=$tabCount['countUser'];
    $reste=$nbrUser % $size;   
    if($reste===0) 
        $nbrPage=$nbrUser/$size;   
    else
        $nbrPage=floor($nbrUser/$size)+1;  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion des utilisateurs</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

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
<h3 class="page-title">Users</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
<li class="breadcrumb-item active">Report User</li>
</ul>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 d-flex">

<div class="card card-table flex-fill">
<div class="card-header">
<h4 class="card-title float-start">User List</h4>
<div class="table-search float-end">
<form method="get" action="users.php" class="form">
<input type="text" name="login" class="form-control" placeholder="Search" value="<?php echo $login; ?>">
<button type="submit" class="btn btn-success">
     <span class="glyphicon glyphicon-search"></span>
     <i class="fa fa-search"></i>
</button> 
</form>
</div>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<thead>
<tr>
<th>User</th><th>civilite</th> <th>Email</th> <th>Role</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
<?php while($user=$resultatUser->fetch()){ ?>
<tr>
<td>
<h2 class="table-avatar">
<a href="my_profil.php?idUser=<?php echo $user['iduser'] ?>" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="../images/<?php echo $user['photo']?>" alt=""></a>
<a href=""><?php echo $user['login']." ". $user['prenom'] ?> <span>#<?php echo $user['iduser'] ?></span></a>
</h2>
</td>
<td><?php echo $user['civilite'] ?></td>
<td><?php echo $user['email'] ?> </td>
<td><?php echo $user['role'] ?> </td>
<td class="text-end">
<div class="actions">
<a href="editerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>" class="btn btn-sm bg-success-light me-2">
<i class="fe fe-pencil"></i>
</a>
<a href="supprimerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>" class="btn btn-sm bg-danger-light">
<i class="fe fe-trash"></i>
 </a>
 <a  href="activerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>&etat=<?php echo $user['etat']  ?>" class="btn btn-sm bg-danger-light">

<?php  
     if($user['etat']==1)
    echo '<i class="fa fa-times" aria-hidden="true"></i>';
    else 
    echo '<i class="fa fa-check" aria-hidden="true"></i>';
    ?>
 </a>
</div>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<div class="ms-2">
<nav aria-label="...">
  <ul class="pagination pagination-sm">
  <?php for($i=1;$i<=$nbrPage;$i++){ ?>
    <li class="page-item <?php if($i==$page) echo 'active' ?>">
    <a class="page-link" href="users.php?page=<?php echo $i;?>&login=<?php echo $login ?>">
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