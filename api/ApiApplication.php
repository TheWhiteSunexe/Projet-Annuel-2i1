<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/ApplicationDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['id'])) {
        echo json_encode(['success' => false, 'error' => 'Utilisateur non authentifié']);
        exit;
    }

    if (!isset($_POST['price']) || !isset($_POST['contract_id'])) {
        echo json_encode(['success' => false, 'error' => 'Champs manquants']);
        exit;
    }

    $id_contract = trim($_POST['contract_id']);
    $price = trim($_POST['price']);
    $id_user = $_SESSION['id'];

    if (!is_numeric($id_contract) || !is_numeric($price) || $price < 0) {
        echo json_encode(['success' => false, 'error' => 'Données invalides']);
        exit;
    }

    $success = ApplicationDAO::addApplication((int) $id_user, (int) $id_contract, (int) $price);

    if ($success && !isset($success['error'])) {
        header('location: /Projet-annuel-2i1/PA2i1/views/providers/application.php');
        echo json_encode([
            'success' => true,
            'data' => $success
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $success['error'] ?? 'Échec de l’ajout de la candidature'
        ]);
    }
}


$id = $_SESSION['id'];
$contracts = ApplicationDAO::getAllApplication();
echo json_encode($contracts);

