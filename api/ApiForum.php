<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/ForumDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['title']) || empty($_POST['title'])) {
        echo json_encode(['success' => false, 'error' => 'Titre manquant']);
        exit;
    }

    if (!isset($_SESSION['id'])) {
        echo json_encode(['success' => false, 'error' => 'Utilisateur non authentifié']);
        exit;
    }

    $id = $_SESSION['id'];
    $title = trim($_POST['title']);

    $successTopic = ForumDAO::addTopic($id, $title);

    if ($successTopic) {

        header('Location: /Projet-Annuel-2i1/PA2i1/views/employees/forum.php');
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'ajout du sujet']);
    }
}

$topics = ForumDAO::getForumTopics();

echo json_encode($topics);



