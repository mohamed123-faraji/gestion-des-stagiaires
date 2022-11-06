<?php
require_once('identifier.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Changement de mot de passe</title>
<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/feathericon.min.css">
<link rel="stylesheet" href="../assets/plugins/morris/morris.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/monjs.js"></script>
</head>
<body>

<div class="main-wrapper login-body">
<div class="login-wrapper">
<div class="container">
<div class="loginbox">
<div class="login-right">
<div class="login-right-wrap">
<h1>Edit Password</h1>
<p class="account-subtitle"></p>

<form method="post" action="updatePwd.php">
<div class="input-container">
<input class="form-control oldpwd" name="oldpwd" type="password" placeholder="Taper votre Ancien Mot de passe"  required>
<i class="fa fa-eye fa-2x show-old-pwd clickable"></i>
</div>
<div class="input-container">
<input class="form-control newpwd" name="newpwd" type="password" placeholder="Taper votre Nouveau Mot de passe"  required>
<i class="fa fa-eye fa-2x show-new-pwd clickable"></i>
</div>
<div class="form-group mb-0">
<button class="btn btn-primary btn-block" value="Edit" type="submit">Edit Password</button>
</div>
</form>

<div class="text-center dont-have">
<?php if (!empty(isset($_GET['msg']))) { ?>
        <div>
            <?php echo $_GET['msg'];
            header("refresh:3;index.php");
             ?>
        </div>
    <?php } ?>
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