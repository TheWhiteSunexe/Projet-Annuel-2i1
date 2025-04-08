<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/eventDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non authentifié']);
    exit();
}

$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['id']) || !isset($input['action'])) {
        echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
        exit();
    }

    $eventId = $input['id'];
    $action = $input['action'];

    try {
        if ($action === 'follow') {
            $success = CourseEventDAO::reserveEvent($userId, $eventId);
            echo json_encode(['success' => $success, 'message' => $success ? 'Réservation réussie' : 'Erreur lors de la réservation']);
        } elseif ($action === 'unfollow') {
            $success = CourseEventDAO::unreserveEvent($userId, $eventId);
            echo json_encode(['success' => $success, 'message' => $success ? 'Désinscription réussie' : 'Erreur lors de la désinscription']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Action inconnue']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
    }
    exit(); 
}

$idEntreprise = CourseEventDAO::getUserCompanyId($userId);
$events = CourseEventDAO::getCourseEvents($idEntreprise);
echo json_encode($events);

