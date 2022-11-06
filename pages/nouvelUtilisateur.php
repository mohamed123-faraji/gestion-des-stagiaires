<?php

require_once("connexiondb.php");
require_once("../les_fonctions/fonctions.php");

$requeteF="select * from etablissements";
$etablissementsF=$pdo->query($requeteF);

$validationErrors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $login = $_POST['login'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $email = $_POST['email'];
    $prenom=$_POST['prenom'];
    $civilite=$_POST['civilite'];

    if (isset($login)) {
        $filtredLogin = filter_var($login, FILTER_SANITIZE_STRING);

        if (strlen($filtredLogin) < 4) {
            $validationErrors[] = "Erreur!!! Le login doit contenir au moins 4 caratères";
        }
    }
    if (isset($prenom)) {
        $filtredPrenom = filter_var($prenom, FILTER_SANITIZE_STRING);

        if (strlen($filtredPrenom) < 3) {
            $validationErrors[] = "Erreur!!! Le prenom doit contenir au moins 3 caratères";
        }
    }

    if (isset($pwd1) && isset($pwd2)) {

        if (empty($pwd1)) {
            $validationErrors[] = "Erreur!!! Le mot ne doit pas etre vide";
        }

        if (md5($pwd1) !== md5($pwd2)) {
            $validationErrors[] = "Erreur!!! les deux mot de passe ne sont pas identiques";

        }
    }

    if (isset($email)) {
        $filtredEmail = filter_var($login, FILTER_SANITIZE_EMAIL);

        if ($filtredEmail != true) {
            $validationErrors[] = "Erreur!!! Email  non valid";

        }
    }

    if (empty($validationErrors)) {
        if (rechercher_par_login($login) == 0 & rechercher_par_email($email) == 0) {
            $requete = $pdo->prepare("INSERT INTO utilisateur(login,email,pwd,role,etat,prenom,civilite,photo) 
                                        VALUES(:plogin,:pemail,:ppwd,:prole,:petat,:pprenom,:pcivilite,:photo)");

            $requete->execute(array('plogin' => $login,
                'pemail' => $email,
                'ppwd' => md5($pwd1),
                'prole' => 'VISITEUR',
                'petat' => 1,
                'pprenom'=>"",
                'pcivilite'=> "F",
                'photo'=> "",
            ));

            $success_msg = "Félicitation, votre compte est crée, mais temporairement inactif jusqu'a activation par l'admin";
            

        } else {
            if (rechercher_par_login($login) > 0) {
                $validationErrors[] = 'Désolé le login exsite deja';
            }
            if (rechercher_par_email($email) > 0) {
                $validationErrors[] = 'Désolé cet email exsite deja';
            }
        }

    }

}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Gestion Stagiaire</title>

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
<h1>Register</h1>
<p class="account-subtitle"></p>
          <form method="post" class="form" enctype="multipart/form-data" >
          <?php

if (isset($validationErrors) && !empty($validationErrors)) {
    foreach ($validationErrors as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    header('refresh:3;url=nouvelUtilisateur.php');
}


if (isset($success_msg) && !empty($success_msg)) {
    echo '<div class="alert alert-success">' . $success_msg . '</div>';

    header('refresh:3;url=login.php');
}
?>
                        <div class="form-group">
                            
                                <input  class="form-control" 
                                type="text"
                                required="required"
                                minlength="4"
                                title="Le login doit contenir au moins 4 caractères..."
                                name="login"
                                placeholder="Taper votre nom d'utilisateur"
                                autocomplete="off"
                   >
                        </div>
                        <div class="form-group">
                           
                                <input  class="form-control" 
                                type="text"
                                required="required"
                                minlength="4"
                                title="Le prenom doit contenir au moins 3 caractères..."
                                name="prenom"
                                placeholder="Taper votre prenom d'utilisateur"
                                autocomplete="off"
                   >
                            
                        </div>
                        <div class="form-group">
                           
                                <input required="required"
                                     minlength="3"
                                     title="Le Mot de passe doit contenir au moins 3 caractères..." 
                                     name="pwd1" 
                                     placeholder="Taper votre mot de passe" 
                                     autocomplete="new-password" 
                                     type="password"
                                     class="form-control" 
                                     id="pwd1" 
                                    >
                            
                        </div>
                        <div class="form-group">
                                <input required="required"
                                     minlength="3"
                                     name="pwd2" 
                                     placeholder="retaper votre mot de passe pour le confirmer" 
                                     autocomplete="new-password" 
                                     type="password" 
                                     class="form-control" 
                                     id="pwd2" 
                                    >
                        </div>
                        <div class="form-group">
                            
                                <input required="required" autocomplete="off" type="email" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}" name="email" class="form-control email" id="email" placeholder="exemple@gmail.com">
                            
                        </div>
                       
                        <div class="form-group text-center">
                            
                                <input name="civilite"  value="M"  type="radio"><i > Homme</i>
                                &nbsp;&nbsp;<input name="civilite" value="F" checked="" type="radio"><i >Femme</i>
                            
                        </div>
                        
                        <div class="form-group"> 
                                <input type="submit" name="inscription" class="btn btn-primary btn-block"  value="Sign Up Now" />
                        </div>
                    </form>
                    <div class="text-center forgotpass">
                   <span>you have a account?</span><a href="login.php">Login</a>
               </div>
                </div>
            </div> <!--End Row-->
                    </div>
        </div>
    </div> <!--End Registration page div-->
</div> <!--End Main Wrapper div-->
</div>

    
   


</body>

</html>



