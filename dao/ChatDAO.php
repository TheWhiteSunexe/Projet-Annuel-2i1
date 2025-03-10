<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

function getMessages( $conversationId) {
    $bdd = getDatabaseConnection();
    $query = "SELECT c.commentaire_id, c.message_id, c.utilisateur_id, c.contenu, c.date_creation,c.active, u.name, u.firstname
              FROM forum_commentaires c
              JOIN users u ON c.utilisateur_id = u.id
              WHERE c.message_id = :sujet AND c.active !=0 ORDER BY c.date_creation ASC ";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['sujet' => $conversationId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addMessage( $conversationId, $userId, $content, $visible) {
    $bdd = getDatabaseConnection();
    $query = "INSERT INTO forum_commentaires (message_id, utilisateur_id, contenu, date_creation, active) 
              VALUES (:message_id, :utilisateur_id, :contenu, NOW(), :active)";
    $stmt = $bdd->prepare($query);
    return $stmt->execute([
        'message_id' => $conversationId,
        'utilisateur_id' => $userId,
        'contenu' => htmlspecialchars($content),
        'active' => $visible
    ]);
}
function getChatTitle($conversationId) {
    $bdd = getDatabaseConnection();
    $query = "SELECT titre FROM forum_messages WHERE message_id = :conversationId";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['conversationId' => $conversationId]);
    return $stmt->fetchColumn(); 
}
?>
