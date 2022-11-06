<?php
require "include/PHPMailer.php";
require "include/SMTP.php";
require "include/Exception.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail=new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->Username ="mohmedfaraji5@gmail.com";
$mail->Password = "13258079faraji";
$mail->Subject = "Test Email Using PHPMailer";
$mail->setFrom("mohmedfaraji5@gmail.com");
$mail->Body = "This is plain text email";
$mail->addAddress("mohmedfaraji5@gmail.com");
$mail->Send();
$mail->smtpClose();
if($mail->Send())
{
	echo "email envoyer avec succés";
}
else{echo "Error...!";}


 ?>