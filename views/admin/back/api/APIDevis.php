<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAODevis.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action =  $data['action'] ?? null;
    $id = $data['id'] ?? null;

    if (!$id) {
        echo json_encode([
            'success' => false,
            'error' => "L'ID du signalement est requis."
        ]);
        exit;
    }

    if ($action === 'changeAcceptedStatus') {
        $result = DevisDAO::changeAcceptedStatus($id);
        if ($result === true) {
            $message = "Le status du devis $id à été accepté avec succès.";
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la résolution."
            ]);
        }
    } elseif ($action === 'changeRefusedStatus') {
        $result = DevisDAO::changeRefusedStatus($id);
        if ($result === true) {
            $message = "Le status du devis $id à été refusé avec succès";
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la résolution."
            ]);
        }
    } elseif ($action === 'startApplication') {
        $result = DevisDAO::startApplication($id);
        if ($result === true) {
            $message = "Les candidatures $id ont été lancées avec succès.";
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la création du signalement."
            ]);
        }
    } elseif ($action === 'endApplication') {
        $result = DevisDAO::endApplication($id);
        if ($result === true) {
            $message = "Les candidatures $id ont été fermées avec succès.";
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la création du signalement."
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'error' => "Action invalide."
        ]);
        exit;
    }
    
    exit;
}

$id = $_SESSION['id'];
$contracts = DevisDAO::getAllDevis();
echo json_encode($contracts);

