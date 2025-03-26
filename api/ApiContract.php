<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié']);
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/contractDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['id'])) {
        echo json_encode(['success' => false, 'error' => 'Utilisateur non authentifié']);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id'], $data['action'])) {
        echo json_encode(['success' => false, 'error' => 'Champs manquants']);
        exit;
    }

    $id = trim($data['id']);
    $action = trim($data['action']);

    if ($action === "accept") {
        $result = ContractDAO::acceptContract($id);
    } elseif ($action === "refuse") {
        $result = ContractDAO::refuseContract($id);
        $result2 = ContractDAO::reactivateApplication($id);
    } else {
        echo json_encode(['success' => false, 'error' => 'Action invalide']);
        exit;
    }

    if (isset($result['error'])) {
        echo json_encode(['success' => false, 'error' => $result['error']]);
    } else {
        echo json_encode(['success' => true, 'message' => "Contrat mis à jour avec succès."]);
    }

    exit;
}

$id = $_SESSION['id'];
$contracts = ContractDAO::getAllContracts($id);
echo json_encode($contracts);
