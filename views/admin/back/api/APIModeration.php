<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOModeration.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getModerations() {
    $dao = new DAOModeration();
    return $dao->getAllModerations();
}

function ruptureContrat($moderationId) {
    $dao = new DAOModeration();
    return $dao->updateActiveStatus($moderationId, 0);
}

function engagerContrat($moderationId) {
    $dao = new DAOModeration();
    return $dao->updateActiveStatus($moderationId, 1);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'];
    $moderationId = $data['id'];

    if ($action === 'rupture') {
        $result = ruptureContrat($moderationId);
    } elseif ($action === 'engager') {
        $result = engagerContrat($moderationId);
    }

    if ($result !== false) {
        $moderations = getModerations();
        echo json_encode(['status' => 'success', 'moderation' => $moderations]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur de mise à jour du contrat.']);
    }

    exit;
}

$moderations = getModerations();
header('Content-Type: application/json');
echo json_encode($moderations);
?>
