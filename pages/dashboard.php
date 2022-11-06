
<?php
     require_once('identifier.php');
     require_once("connexiondb.php");
    require_once('../les_fonctions/fonctions.php');
     
     //nbr de stagiaire et nbr de visiteur et nbr de stages
     $requete="select count(*) as nbr from stagiaire";
     $result=$pdo->query($requete);
        $row=$result->fetch();
        $nbrStagiaire=$row['nbr'];
     //nbr de utilisateur
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
<!DOCTPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Les stagiaires </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/bootstrap.min.js"></script>
</head>

<body>

<?php include('menu.php'); ?>
<br><br>
<div class="container  tableau-stat text-center">
    <h1 class="text-center text-primary">Statistiqus de l'entreprise</h1>
    <div class="row">

        <!-- ************ Total des inscrits en 1ère année et 2ème année ******************  -->

        <div class="col-md-4">
            <div class="stat stat12">
                <span class="fa fa-users"></span>
                <div class="effectif">
                    Efectif de les utilisateurs
                    <div class="nbr"><?php echo $nbrUtilisateur?></div>
                </div>

            </div>
        </div>

        <!-- ************* Total des inscrits en 1ère année  *****************  -->

        <div class="col-md-4">
            <div class="stat stat1">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Efectif de les stagiaires
                    <div class="nbr"><?php echo $nbrStagiaire ?> </div>
                </div>
            </div>
        </div>

        <!-- ************* Total des inscrits en 2ème année *****************  -->


        <div class="col-md-4">
            <div class="stat stat2">
            <i class="fa fa-vcard"></i>
                <div class="effectif">
                    Efectif de les stages
                    <div class="nbr"><?php echo $nbrStage ?> </div>
                </div>
            </div>
        </div>


    </div>
</div>

</body>
</html>
