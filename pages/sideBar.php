
<?php
   require_once('identifier.php');
   require_once("connexiondb.php");
?>

<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="menu-title">
</li>
<li>
<a href="index.php"><i class="fe fe-home"></i> <span>Dashboard</span></a>
</li>
<?php if($_SESSION['user']['role']=="ADMIN") {?>
<li><a href="users.php"><i class="fe fe-users"></i><span> Utilisateurs</span></a></li>
<li><a href="stagiaire.php"><i class="fe fe-users"></i><span> Stagiaires</span></a></li>
<li><a href="encadrants.php"><i class="fe fe-users"></i><span> encadrants</span></a></li>
<li><a href="offres.php"><i class="fa fa-vcard"></i><span> Offres</span></a></li>
<li><a href="filieres.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span> Filieres</span></a></li>
<li><a href="etablissement.php"><i class="fa fa-university" aria-hidden="true"></i><span> Etablissements</span></a></li>
<li><a href="demande_stage.php"<i class="fa fa-vcard"></i><span> Demandes</span></a></li>
<li><a href="stages.php"<i class="fa fa-vcard"></i><span> Stages</span></a></li>
<?php };?>
<?php if($_SESSION['user']['role']=="VISITEUR") {?>
<li><a href="offres.php"><i class="fa fa-vcard"></i><span> Offres</span></a></li>
<li><a href="user_stages.php"><i class="fa fa-vcard"></i><span> Mes stages</span></a></li>
<li><a href="../fpdf/page_document.php"><i class="fa fa-book" aria-hidden="true"></i><span> Mes Documents</span></a></li>
<li><a href="contact-us.php"><i class="fa fa-commenting-o" aria-hidden="true"></i><span> Contact</span></a></li>
<?php };?>
</ul>
</div>
</div>
</div>
