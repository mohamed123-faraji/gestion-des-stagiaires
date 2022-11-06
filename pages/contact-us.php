<?php 
require_once('identifier.php');
require_once("connexiondb.php");
require "../phpmailer/include/PHPMailer.php";
          require "../phpmailer/include/SMTP.php";
          require "../phpmailer/include/Exception.php";
          use PHPMailer\PHPMailer\PHPMailer;
          use PHPMailer\PHPMailer\SMTP;
          use PHPMailer\PHPMailer\Exception;
          ini_set("SMTP","ssl:smtp.gmail.com" );
          ini_set("smtp_port","465");
$mail_error ="";
$mail__errors ="";
$mail__success ="";
if(isset($_POST['send'])){
 $name = stripslashes(trim($_POST['name']));
 $email = stripslashes(trim($_POST['email']));
 $subject = stripslashes(trim($_POST['subject']));
 $message = stripslashes(trim($_POST['message']));
   if(empty($name)||empty($email)||empty($subject)||empty($message)){
       $mail__errors ="Veuillez remplir tous les champs";
       header("refresh:3;url=contact-us.php");
       //exit();
   }
   else{
      
  $toEmail = "gestionstagiaire123@gmail.com";
  $mailHeaders = "From: " . $name . "<". $email .">\r\n";

  if(mail($toEmail, $subject, $message, $mailHeaders)) {
      $mail_success = "email a envoyer avec success.";
    $type_mail_msg = "success";
  }else{
    $mail__error = "Erreur lors de l'envoi de l'e-mail.";
    $type_mail = "error";
  }
   }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Contact</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
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
<h3 class="page-title">Contact Nous </h3>
<ul class="breadcrumb">
<li class="breadcrumb-item active"></li>
</ul>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card">
<div class="card-header">
 <h4 class="card-title">Contact Nous</h4>
</div>
<div class="card-body">
<form method='post' onsubmit="return validate()" class='form' enctype='multipart/form-data'>
<div class='form-group'>
<label for='name'>Nom :</label>
<input type='text' name='name' placeholder='Name' class='form-control'>
</div>
<div class='form-group'>
<label for='email'>Email :</label>
<input type='email' name='email' placeholder='Email' class='form-control'>
</div>
<div class='form-group'>
<label for='subject'>Subject :</label>
<input type='text' name='subject' placeholder='Sujet' class='form-control'>
</div>
<div class='form-group'>
<label for='message'>Message :</label>
<textarea name="message"  rows="5" placeholder="Message" class="form-control col-md-9"></textarea>
</div>
<div class='text-end'>
<button type='submit' name="send" class='btn btn-primary'>
<span ><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
Envoyer
</button>
</div>
</form>
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