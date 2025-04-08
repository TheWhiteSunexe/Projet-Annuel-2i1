<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/RoomDAO.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['capacity'], $_POST['address'], $_POST['postal_code'], $_POST['city'], $_POST['country'])) {

        $name = trim($_POST['name']);
        $capacity = trim($_POST['capacity']);
        $address = trim($_POST['address']);
        $postal_code = trim($_POST['postal_code']);
        $city = trim($_POST['city']);
        $country = trim($_POST['country']);

        if (!isset($_SESSION['id'])) {
            echo json_encode(['success' => false, 'error' => 'Utilisateur non authentifié']);
            exit;
        }

        $id_user = $_SESSION['id'];
        $id = RoomDAO::GetIdclient($id_user);

        if ($id) {
            $successDevis = RoomDAO::addRoom($name, $capacity, $address, $postal_code, $city, $country, $id);
            
            header('location: /Projet-annuel-2i1/PA2i1/views/clients/room.php');
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
$idClient = RoomDAO::GetIdclient($id);
$room = RoomDAO::getAllRoom($idClient);
echo json_encode($room);

