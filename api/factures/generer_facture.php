<?php
require_once '../../utils/database.php';
require_once '../../dao/FactureClientDAO.php';
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;

$clientId = $_POST['client_id'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$date = date('Y-m-d');

$html = "
    <h1 style='text-align:center;'>Facture - Business Care</h1>
    <p><strong>Date :</strong> $date</p>
    <p><strong>Client ID :</strong> $clientId</p>
    <p><strong>Montant :</strong> $amount €</p>
    <p><strong>Description :</strong><br>$description</p>
";

// Création du PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Chemin
$uniqueName = uniqid("facture_") . ".pdf";
$outputPath = "../../factures/clients/$uniqueName";
file_put_contents($outputPath, $dompdf->output());

$relPath = "factures/clients/$uniqueName";
FactureClientDAO::insert($clientId, $amount, $description, $relPath);

echo json_encode(['status' => 'ok', 'path' => $relPath]);
