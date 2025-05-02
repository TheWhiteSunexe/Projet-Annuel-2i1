<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ForumDAO {
    
    public static function getForumTopics() {
        $db = getDatabaseConnection();

        // Récupérer les sujets du forum
        $query = "SELECT titre, date_creation, utilisateur_id, message_id, contenu FROM forum_messages ORDER BY date_creation DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($topics as &$topic) {
            // Récupérer l'utilisateur
            $userQuery = "SELECT name, firstname FROM users WHERE id = :id";
            $userStmt = $db->prepare($userQuery);
            $userStmt->execute(['id' => $topic['utilisateur_id']]);
            $user = $userStmt->fetch(PDO::FETCH_ASSOC);
            $topic['nom_utilisateur'] = $user['name'];
            $topic['prenom_utilisateur'] = $user['firstname'];

            // Nombre de messages
            $msgQuery = "SELECT COUNT(*) AS total_messages FROM forum_commentaires WHERE message_id = :id";
            $msgStmt = $db->prepare($msgQuery);
            $msgStmt->execute(['id' => $topic['message_id']]);
            $topic['nb_messages'] = $msgStmt->fetch(PDO::FETCH_ASSOC)['total_messages'];

            // Nombre de vues
            $viewQuery = "SELECT COUNT(*) AS nb_see FROM visite WHERE id_message = :id";
            $viewStmt = $db->prepare($viewQuery);
            $viewStmt->execute(['id' => $topic['message_id']]);
            $topic['nb_see'] = $viewStmt->fetch(PDO::FETCH_ASSOC)['nb_see'];

            // Hashtags associés
            $hashtagQuery = "SELECT name FROM hashtags WHERE id IN (SELECT id_hashtag FROM concerne WHERE id_message = :id)";
            $hashtagStmt = $db->prepare($hashtagQuery);
            $hashtagStmt->execute(['id' => $topic['message_id']]);
            $hashtags = $hashtagStmt->fetchAll(PDO::FETCH_COLUMN);
            $topic['hashtags'] = $hashtags;
        }

        return $topics;
    }

    public static function addTopic($id, $title) {
        $db = getDatabaseConnection();
    
        $query = "INSERT INTO forum_messages (utilisateur_id, titre, contenu, date_creation) 
                  VALUES (:id, :title, NULL, NOW())";
        $stmt = $db->prepare($query);
        $success = $stmt->execute([
            ':id' => $id,
            ':title' => $title
        ]);
    
        return $success;
    }
    
}
class ForumMessageDAO {
    
    public static function getRecentMessages($limit = 5) {
        $db = getDatabaseConnection();

        // Récupérer les derniers messages du forum
        $query = "SELECT titre, date_creation, utilisateur_id, message_id FROM Forum_messages ORDER BY date_creation DESC LIMIT :limit";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as &$message) {
            // Récupérer les informations de l'utilisateur
            $userQuery = "SELECT name, firstname FROM users WHERE id = :id";
            $userStmt = $db->prepare($userQuery);
            $userStmt->execute(['id' => $message['utilisateur_id']]);
            $user = $userStmt->fetch(PDO::FETCH_ASSOC);
            $message['nom_utilisateur'] = htmlspecialchars($user['name']);
            $message['prenom_utilisateur'] = htmlspecialchars($user['firstname']);

            // Formater la date
            $message['date_formattee'] = date('d/m/Y', strtotime($message['date_creation']));
            if (date('Y-m-d') === date('Y-m-d', strtotime($message['date_creation']))) {
                $message['date_formattee'] = date('H:i', strtotime($message['date_creation']));
            }
        }

        return $messages;
    }
}

class ForumStatsDAO {
    
    public static function getForumStats() {
        $db = getDatabaseConnection();

        // Récupérer le nombre total de sujets
        $queryTopics = "SELECT COUNT(*) AS total_topics FROM Forum_messages";
        $resultTopics = $db->query($queryTopics);
        $totalTopics = $resultTopics->fetch(PDO::FETCH_ASSOC)['total_topics'];

        // Récupérer le nombre total de messages
        $queryMessages = "SELECT COUNT(*) AS total_messages FROM Forum_commentaires";
        $resultMessages = $db->query($queryMessages);
        $totalMessages = $resultMessages->fetch(PDO::FETCH_ASSOC)['total_messages'];

        // Récupérer le nombre total d'utilisateurs
        $queryUsers = "SELECT COUNT(*) AS total_users FROM users";
        $resultUsers = $db->query($queryUsers);
        $totalUsers = $resultUsers->fetch(PDO::FETCH_ASSOC)['total_users'];

        // Récupérer le dernier utilisateur inscrit
        $queryLastUser = "SELECT name, firstname FROM users ORDER BY expiration DESC LIMIT 1";
        $resultLastUser = $db->query($queryLastUser);
        $lastUser = $resultLastUser->fetch(PDO::FETCH_ASSOC);
        $lastUserName = htmlspecialchars($lastUser['firstname'] . ' ' . $lastUser['name']);

        return [
            'total_topics' => $totalTopics,
            'total_messages' => $totalMessages,
            'total_users' => $totalUsers,
            'last_user_name' => $lastUserName
        ];
    }
}