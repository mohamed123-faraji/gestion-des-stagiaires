<?php
require_once('connexiondb.php');

require_once('../les_fonctions/fonctions.php');
// use phpmailer
//ini_set('SMTP', "smtp.gmail.com");
//ini_set('smtp_port', "465");
//ini_set('sendmail_from', "gestionstagiaires123@gmail.com");
if (isset($_POST['email']))
    $email = $_POST['email'];
else
    $email = "";

$user = rechercher_user_par_email($email);
 $to="";
 $objet="";
 $content="";
 $entetes="";
 $erreur="";
if ($user != null) {
    $id = $user['iduser'];
    $requete = $pdo->prepare("update utilisateur set pwd=MD5('0000') where iduser=$id");
    $requete->execute();
    $to = $user['email'];
    $objet = "Initialisation de votre mot de passe";
    $content = "Votre mot de passe a été initialisé à 0000";
    $entetes = "From: Gestion Stagiaire " ."\r\n" .
        "Reply-To: gestionstagiaires123@gmail.com";

    }
    if(mail($to, $objet, $content, $entetes))
    {
      $erreur="non";
   $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email.";
    }
    else {
        
            $erreur="oui";
    
            $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";
        
      
    
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Dreamchat - Dashboard</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/css/font-awesome.min.css">

<link rel="stylesheet" href="../assets/css/feathericon.min.css">

<link rel="stylesheet" href="../assets/plugins/morris/morris.css">

<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="main-wrapper login-body">
<div class="login-wrapper">
<div class="container">
<div class="loginbox">
<div class="login-right">
<div class="login-right-wrap">
<h1>Forgot Password?</h1>
<p class="account-subtitle">Enter your email to get a password reset link</p>

<form method="post">
<div class="form-group">
<input class="form-control" name="email" type="text" placeholder="Email">
</div>
<div class="form-group mb-0">
<button class="btn btn-primary btn-block" type="submit">Reset Password</button>
</div>
</form>

<div class="text-center dont-have">Have a account? <a href="login.php">Login</a></div>
</div>
</div>

</div>

</div>
<?php if($user != null){?>
<div class="text-center">

    <?php

    if ($erreur == "oui") {

        echo '<div class="alert alert-danger">' . $msg . '</div>';

        header("refresh:6;url=initialiserPwd.php");

        exit();
    } else if ($erreur == "non") {

        echo '<div class="alert alert-success">' . $msg . '</div>';

        header("refresh:6;url=login.php");

        exit();
    }

    ?>

</div>
<?php };?>
</div>

</div>


<script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/js/script.js"></script>
</body>
</html>