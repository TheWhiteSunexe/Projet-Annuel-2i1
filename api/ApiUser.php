<?php
session_start();
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/UserDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode([
        'success' => false,
        'error' => "Utilisateur non authentifié."
    ]);
    exit;
}

$userId = $_SESSION['id'];
$userData = DAOUser::getUserById($userId);

if ($userData) {
    echo json_encode([
        'success' => true,
        'data' => $userData
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => "Utilisateur non trouvé."
    ]);
}
?>
