<?php
  require_once('../pages/identifier.php');
  require_once("../pages/connexiondb.php");
  include('../les_fonctions/fonctions.php');
  require('./makefont/makefont.php');

//$pdo = new PDO("mysql:host=localhost;dbname=ecoledb", "root", "");

if (isset($_GET['idS'])&& isset($_GET['db'])&& isset($_GET['df'])&& isset($_GET['nomF']))
   {$date_debut=$_GET['db'];
    $date_fin=$_GET['df'];
    $nomf=$_GET['nomF'];
    $ids = $_GET['idS'];
    $niveau=$_GET['niveau'];
    $sujet_stage=$_GET['sj'];
}

else
    $ids = 0;

if (isset($_GET['as']))
    $as = $_GET['as'];
else
    $as = annee_scolaire_actuelle();

$identite_stagiaire = $pdo->query("SELECT login,prenom FROM stagiaire st,utilisateur u WHERE u.iduser=st.iduser and st.idStagiaire=$ids");
$stagiaire = $identite_stagiaire->fetch();

$nom_prenom = strtoupper($stagiaire['login'] . "  " . $stagiaire['prenom']);
$date_insc = dateEnToDateFr($date_debut);
$date_insc_fin = dateEnToDateFr($date_fin);

$num_insc = strtoupper($ids);


$filiere = strtoupper($nomf);

$niveau = strtoupper($niveau);

//definir le codage en utf-8 et windows-1252 pour l'affichage du pdf on utilise la fonction iconv


require('./fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A5)
$pdf = new FPDF('P', 'mm', 'A5');
//utiliser iconv pour convertir le nom de la filière en utf-8
$mot = iconv('UTF-8', 'windows-1252', "Je soussigné Mohamed elfaraji agissant en tant que directeur pour  l’entreprise situé à casablanca");
 $mot1=iconv('UTF-8', 'windows-1252', "Cette formation s’est tenue à l'entreprise atlas de casablanca du $date_debut au $date_fin.");
  $mot2=iconv('UTF-8','windows-1252',"Les objectifs de cette formation étaient les suivants : realisation d'un $sujet_stage.");
  $mot3=iconv('UTF-8','windows-1252',"La présente attestation est délivrée à l'intéressé Pour servir et valoir ce que de droit.");
  $mot4=iconv('UTF-8','windows-1252',"Fait à Casablanca Le");



//Ajouter une nouvelle page
$pdf->AddPage();

// entete
//$pdf->Image('en-tete.png', 10, 5, 130, 20);

// Saut de ligne
$pdf->Ln(18);


// Police Arial gras 16
$pdf->SetFont('Arial', 'B', 16);

// Titre
$pdf->Cell(0, 10, 'ATTESTATION REUSSITE STAGE', 'TB', 1, 'C');

// Saut de ligne
$pdf->Ln(5);

// Début en police Arial normale taille 10

$pdf->SetFont('Arial', '', 10);
$h = 7;
$retrait = "      ";

$pdf->Write($h, "$mot,\nAtteste que:\n");

$pdf->Write($h,"$mot1\n");


//Ecriture normal
$pdf->SetFont('', '');




$pdf->Write($h,"$mot2" . " \n");



$pdf->Write($h, "$mot3\n");

$pdf->Cell(0, 5,  $mot4.' :' . date('d/m/Y'), 0, 1, 'C');

// Décalage de 20 mm à droite
$pdf->Cell(20);
$pdf->Cell(80, 8, "Le directeur  de l'entreprise", 1, 1, 'C');

// Décalage de 20 mm à droite
$pdf->Cell(20);
$pdf->Cell(80, 5, "Mr Mohamed  Elfaraji", 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C'); // LR Left-Right
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LRB', 1, 'C'); // LRB : Left-Right-Bottom (Bas)

//Afficher le pdf
$pdf->Output('', '', true);
?>

