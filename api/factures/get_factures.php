<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Non authentifié']);
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/FactureClientDAO.php';

$id = $_SESSION['id'];
echo json_encode(FactureClientDAO::getAllByClient($id));
