<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/controllers/ChatController.php';

header("Content-Type: application/json");

$action = $_GET['action'] ?? '';

if ($action === 'getMessages' && isset($_GET['conversationId'])) {

    echo json_encode(getMessages( $_GET['conversationId']));

} elseif ($action === 'sendMessage' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['conversationId'], $data['userId'], $data['content'])) {
        
        $result = processMessage($data['conversationId'], $data['userId'], $data['content']);
    
        echo json_encode(['success' => $result]);

    } else {
        echo json_encode(['error' => 'Données incomplètes']);
    }

}elseif ($_GET['action'] == 'getChatTitle' && isset($_GET['conversationId'])) {
    $conversationId = $_GET['conversationId'];
    $title = getChatTitle($conversationId);
    
    if ($title !== false) {
        echo json_encode(['success' => true, 'title' => $title]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Aucun titre trouvé']);
    }
    exit;
}else {
    echo json_encode(['error' => 'Action non valide']);
}

?>
