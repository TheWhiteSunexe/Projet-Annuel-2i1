<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOUsers.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getUsers() {
    $dao = new DAOUser();
    return $dao->getAllUsers();
}

function ruptureContrat($userId) {
    $dao = new DAOUser();
    return $dao->updateActiveStatus($userId, 0);
}

function engagerContrat($userId) {
    $dao = new DAOUser();
    return $dao->updateActiveStatus($userId, 1);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'];
    $userId = $data['id'];

    if ($action === 'rupture') {
        $result = ruptureContrat($userId);
    } elseif ($action === 'engager') {
        $result = engagerContrat($userId);
    }

    if ($result !== false) {
        $users = getUsers();
        echo json_encode(['status' => 'success', 'users' => $users]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur de mise à jour du contrat.']);
    }

    exit;
}

$users = getUsers();
header('Content-Type: application/json');
echo json_encode($users);
?>
