<?php

//    require('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
//      require('../vendor/phpmailer/phpmailer/src/SMTP.php');
//     require('../vendor/phpmailer/phpmailer/src/Exception.php');

//   use PHPMailer\PHPMailer\SMTP;
//   use PHPMailer\PHPMailer\PHPMailer;
//   use PHPMailer\PHPMailer\Exception;
//   require '../vendor/autoload.php';
try {

    $pdo = new PDO("mysql:host=localhost;dbname=gestion_stag",
        "root", "");
        //definir le codage en utf-8
        $pdo->exec('SET NAMES UTF8');
        

}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());

    //die('Erreur : impossible de se connecter à la base de donnée');
}
?>

