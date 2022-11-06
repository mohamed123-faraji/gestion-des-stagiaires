<?php
require_once('identifier.php');
require_once('connexiondb.php');
//recuper Id demande
$idD=isset($_GET['idD'])?$_GET['idD']:0;
$email=isset($_GET['email'])?$_GET['email']:"";
$to=$email;
$subject="Reponse à votre demande de stage";
//message pour dire que lew demande est accepter
$message="votre demande de stage est bien recu et accepter,vous devez assister a  l'entreprise pour completer l'affectation de stage";
$entetes = "From: Gestion Stagiaire " ."\r\n" .
"Reply-To: gestionstagiaires123@gmail.com";

//rediriger vers demande.php
 if(mail($to, $subject, $message, $entetes)){
  header("demande_stage.php");
 }
 else {
  $erreur="Email est incorrect";
  $url="stages.php";
  header("location:alerte.php?message=$erreur&url=$url");
 }
  ?>
 

