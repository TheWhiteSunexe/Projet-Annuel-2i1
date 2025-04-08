<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: application/json");
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non authentifié']);
    exit();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/eventDAO.php';
$userId = $_SESSION['id'];
$idEntreprise = CourseEventDAO::getUserCompanyId($userId);
$dates = CourseEventDAO::getEventDates($idEntreprise);
echo json_encode($dates);

