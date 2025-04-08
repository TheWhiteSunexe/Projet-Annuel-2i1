<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/devisDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';

        if (!isset($_SESSION['id'])) {
            echo json_encode(['success' => false, 'error' => 'Utilisateur non authentifié']);
            exit;
        }

        $id_user = $_SESSION['id'];
        $id = DevisDAO::GetIdclient($id_user);
        
        if ($id) {
            $successDevis = DevisDAO::addDevis($name, $title, $description, $id);
            header('location: /Projet-annuel-2i1/PA2i1/views/clients/devis.php');
            echo json_encode([
                'success' => (bool) $successDevis,
                'data' => $successDevis
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Impossible de récupérer l\'ID du client'
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Champs manquants']);
    }
}

$id = $_SESSION['id'];
$contracts = DevisDAO::getAllDevis($id);
echo json_encode($contracts);

