<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAODevis.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action =  $data['action'] ?? null;
    $id = $data['id'] ?? null;

    //NECESSAIRE LORSQU'ON VIENT PAS AVEC DU JSON (plublication annonce devis)
    if (isset($_POST['id'])) {
        $action =  $_GET['action'] ?? null;
        $id = $_POST['id'] ?? null;
    }
    
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
        $id_room = $_POST['room'] ?? null;
        $start_date = $_POST['start_date'] ?? null;
        $end_date = $_POST['end_date'] ?? null;
        $start_hour = $_POST['start_time'] ?? null;
        $end_hour = $_POST['end_time'] ?? null;
        $id_company = $_POST['id_company'] ?? null;
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;

        $result = DevisDAO::startApplication($id, $id_company, $id_room, $start_date, $end_date, $start_hour, $end_hour, $title, $description);
        if ($result === true) {
            $message = "L'annonce $id a été lancée avec succès.";
            echo json_encode(['success' => true, 'message' => $message]);
            header('location: /Projet-annuel-2i1/PA2i1/views/admin/back/devis.php');
        } else {
            echo json_encode([
                'success' => false,
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la l'envoie de la publication."
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
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la supression de la publication."
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

