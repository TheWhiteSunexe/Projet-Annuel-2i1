<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/ApplicationDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié']);
    exit();
}

$id = $_SESSION['id'];
$id_provider = ApplicationDAO::searchProvider((int) $id);

if ($id_provider === null) {
    echo json_encode(['error' => 'Aucun provider trouvé pour cet utilisateur.']);
    exit;
}

$contracts = ApplicationDAO::getAllApplicationHistory($id_provider);
echo json_encode($contracts);

