<?php
session_start();

use Dompdf\Dompdf;
use Dompdf\Options;

include('/var/www/html/includes/db.php');

$q = 'SELECT * FROM users';

$req = $bdd->prepare($q);

$req->execute();

//Recuperer les resultats dans un tableau $results
$results = $req->fetchAll();

ob_start();
require_once 'pdf-content-backend.php';

$html = ob_get_contents();

ob_end_clean();

require_once '/var/www/html/includes/dompdf/autoload.inc.php';

$options = new Options();
$options->set('defaultFont', 'Courier');


$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4','portrait');

$dompdf->render();

$fichier = 'Mes informations.pdf';
$dompdf->stream($fichier);