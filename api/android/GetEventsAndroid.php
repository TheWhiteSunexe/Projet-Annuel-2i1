<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/EventDAO.php';

header("Content-Type: application/json");

$companyId = $_POST['company_id'] ?? null;

if (!$companyId) {
    echo json_encode(['success' => false, 'message' => 'ID entreprise manquant.']);
    exit();
}

try {
    $events = CourseEventDAO::getEventsForAndroid($companyId);
    echo json_encode(['success' => true, 'events' => $events]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
