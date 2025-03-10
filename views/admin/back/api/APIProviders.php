<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOProviders.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getProviders() {
    $dao = new DAOProvider();
    return $dao->getAllProviders();
}

function ruptureContrat($providerId) {
    $dao = new DAOProvider();
    return $dao->updateActiveStatus($providerId, 0);
}

function engagerContrat($providerId) {
    $dao = new DAOProvider();
    return $dao->updateActiveStatus($providerId, 1);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'];
    $providerId = $data['id'];

    if ($action === 'rupture') {
        $result = ruptureContrat($providerId);
    } elseif ($action === 'engager') {
        $result = engagerContrat($providerId);
    }

    if ($result !== false) {
        $providers = getProviders();
        echo json_encode(['status' => 'success', 'providers' => $providers]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur de mise à jour du contrat.']);
    }

    exit;
}

$providers = getProviders();
header('Content-Type: application/json');
echo json_encode($providers);
?>
