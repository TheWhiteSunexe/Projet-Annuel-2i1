<?php
session_start();
header('Content-Type: application/json');
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/NoteDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $userId = $_SESSION['id'];
        $entrepriseId = NoteDAO::getEntrepriseId($userId);
        $notes = NoteDAO::getNotesByUser($entrepriseId);
        echo json_encode(['success' => true, 'notes' => $notes]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];
    $action = $_GET['action'] ?? null;

    if (!$action) {
        echo json_encode(['success' => false, 'message' => 'Action manquante']);
        exit;
    }

    try {
        switch ($action) {
            case 'create':
                $title = $_POST['title'] ?? null;
                $description = $_POST['description'] ?? null;

                if (!$title || !$description) {
                    echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
                    exit;
                }

                $clientId = NoteDAO::getEntrepriseIdFromEmployees($userId);
                $employeeId = NoteDAO::getEmployeesId($userId);

                if (!$clientId || !$employeeId) {
                    echo json_encode(['success' => false, 'message' => 'Employé ou entreprise introuvable']);
                    exit;
                }

                $success = NoteDAO::createNote($title, $description, $employeeId, $clientId);
                echo json_encode(['success' => $success]);
                break;

            case 'fav':
                $noteId = intval($_POST['id'] ?? 0);
                $fav = intval($_POST['fav'] ?? -1);

                if (!$noteId || !in_array($fav, [0, 1])) {
                    echo json_encode(['success' => false, 'message' => 'Paramètres invalides']);
                    exit;
                }

                $success = NoteDAO::updateFavouriteStatus($noteId, $fav);
                echo json_encode(['success' => $success]);
                break;

            case 'delete':
                $noteId = intval($_POST['id'] ?? 0);
                if (!$noteId) {
                    echo json_encode(['success' => false, 'message' => 'ID manquant']);
                    exit;
                }

                $success = NoteDAO::deleteNoteById($noteId);
                echo json_encode(['success' => $success]);
                break;

            default:
                echo json_encode(['success' => false, 'message' => 'Action inconnue']);
        }

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
    }
}
