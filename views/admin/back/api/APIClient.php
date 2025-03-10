<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOClient.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getClients() {
    $dao = new DAOClient();
    return $dao->getAllClients();
}

function ruptureContrat($clientId) {
    $dao = new DAOClient();
    return $dao->updateActiveStatus($clientId, 0);
}

function engagerContrat($clientId) {
    $dao = new DAOClient();
    return $dao->updateActiveStatus($clientId, 1);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'];
    $clientId = $data['id'];

    if ($action === 'rupture') {
        $result = ruptureContrat($clientId);
    } elseif ($action === 'engager') {
        $result = engagerContrat($clientId);
    }

    if ($result !== false) {
        $clients = getClients();
        echo json_encode(['status' => 'success', 'clients' => $clients]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur de mise à jour du contrat.']);
    }

    exit;
}

$clients = getClients();
header('Content-Type: application/json');
echo json_encode($clients);
?>
