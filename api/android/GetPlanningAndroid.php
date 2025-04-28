<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/CalendarDAO.php';

header("Content-Type: application/json");

$userId = $_POST['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'ID utilisateur manquant.']);
    exit();
}

try {
    $planning = EventDAO::getEmployeePlanningForAndroid($userId);
    echo json_encode(['success' => true, 'planning' => $planning]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
