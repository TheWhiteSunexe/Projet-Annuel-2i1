<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/CalendarDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

$userId = $_SESSION['id'];
$events = EventDAO::getUserEvents($userId);

echo json_encode($events);
