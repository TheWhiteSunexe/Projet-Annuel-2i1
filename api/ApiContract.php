<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié']);
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/contract.php';
$id = $_SESSION['id'];
$contracts = ContractDAO::getAllContracts($id);
echo json_encode($contracts);
