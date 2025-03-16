<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Utilisateur non authentifié']);
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/employeesDAO.php';

$method = $_SERVER["REQUEST_METHOD"];
$data = json_decode(file_get_contents("php://input"), true);
$dao = new EmployeesDAO();

if ($method === "GET") {
    echo json_encode($dao->getAllEmployees());
    exit();
}

if ($method === "POST") {
    if (!isset($data['action'])) {
        echo json_encode(['error' => 'Action non spécifiée.']);
        exit();
    }

    if ($data['action'] === 'add') {
        if (!isset($data['name'], $data['firstname'], $data['email'], $data['enterpriseId'])) {
            echo json_encode(['error' => 'Données incomplètes.']);
            exit();
        }
        echo json_encode($dao->addEmployee($data['name'], $data['firstname'], $data['email'], $data['enterpriseId']));
    } elseif ($data['action'] === 'update') {
        if (!isset($data['id'], $data['name'], $data['firstname'], $data['email'])) {
            echo json_encode(['error' => 'Données incomplètes.']);
            exit();
        }
        echo json_encode($dao->updateEmployee($data['id'], $data['name'], $data['firstname'], $data['email']));
    } elseif ($data['action'] === 'suspend') {
        if (!isset($data['id'])) {
            echo json_encode(['error' => 'ID manquant.']);
            exit();
        }
        echo json_encode($dao->suspendEmployee($data['id']));
    } elseif ($data['action'] === 'reactivate') {
        if (!isset($data['id'])) {
            echo json_encode(['error' => 'ID manquant.']);
            exit();
        }
        echo json_encode($dao->reactivateEmployee($data['id']));
    } else {
        echo json_encode(['error' => 'Action non reconnue.']);
    }
}
?>
