<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOApplication.php';


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id_application = $data['id_application'] ?? null;
    $id_contract = $data['id_contract'] ?? null;
    $id_provider = $data['id_provider'] ?? null;
    $price = $data['price'] ?? null;

    if (!$id_application || !$id_contract || !$id_provider || !$price) {
        echo json_encode([
            'success' => false,
            'error' => "Données manquantes"
        ]);
        exit;
    }

    $resultContract = ApplicationDAO::sendContract($id_provider, $id_contract, $id_application,$price);
    $resultUpdate = ApplicationDAO::updateApplication($id_contract);

    if (($resultContract['success'] ?? false) && ($resultUpdate['success'] ?? false)) {
        echo json_encode([
            'success' => true,
            'message' => "La candidature $id_application a été envoyée avec succès."
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $resultContract['error'] ?? $resultUpdate['error'] ?? "Une erreur inconnue s'est produite."
        ]);
    }

    exit;
}


$application = ApplicationDAO::getAllApplications();
echo json_encode($application);
