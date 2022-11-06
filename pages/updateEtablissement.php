<?php
    require_once('identifier.php');

    require_once('connexiondb.php');

    $ide=isset($_POST['idE'])?$_POST['idE']:0;

    $nomE=isset($_POST['nomE'])?$_POST['nomE']:"";

    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";

    $requete="update etablissements set nomEtablissement=?,adresse=? where idEtablissement=?";
    $params=array($nomE,$adresse,$ide);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    header('location:etablissement.php');

  
?>
