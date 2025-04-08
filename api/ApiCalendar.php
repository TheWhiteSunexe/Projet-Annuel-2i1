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

if (isset($_GET['user'])) {
    $role = $_GET['user'];

    if ($role == "providers") {
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            $events = EventDAO::getProvidersEvents($userId);
            echo json_encode($events);
        } else {
            echo json_encode(['error' => 'Utilisateur non authentifié']);
        }
    }
    elseif ($role == "employees") {
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            $events = EventDAO::getEmployeesEvents($userId);
            echo json_encode($events);
        } else {
            echo json_encode(['error' => 'Utilisateur non authentifié']);
        }
    }
    else {
        echo json_encode(['error' => 'Rôle inconnu']);
    }
} else {
    echo json_encode(['error' => 'Paramètre "user" manquant']);
}

// $userId = $_SESSION['id'];
// $events = EventDAO::getUserEvents($userId);

// echo json_encode($events);
