<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';
class NoteDAO {

    public static function getEntrepriseId($userId) {
        $pdo = getDatabaseConnection(); 
        $query = "SELECT id FROM clients WHERE id_user = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['id'] : null;
    }
    public static function getEntrepriseIdFromEmployees($userId) {
        $pdo = getDatabaseConnection(); 
        $query = "SELECT id_enterprise FROM employees WHERE id_users = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result ? $result['id_enterprise'] : null;
    }
    
    public static function getEmployeesId($userId) {
        $pdo = getDatabaseConnection(); 
        $query = "SELECT id FROM employees WHERE id_users = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['id'] : null;
    }

    public static function getNotesByUser($entrepriseId) {
        if (!$entrepriseId) return [];

        $pdo = getDatabaseConnection(); 
        $query = "SELECT id, title, content, created_at, fav, active FROM note WHERE client_id = :id AND active = 1 ORDER BY fav DESC, created_at DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $entrepriseId]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($notes as &$note) {
            $note['title'] = htmlspecialchars($note['title']);
            $note['content'] = htmlspecialchars($note['content']);
            $note['created_at'] = date("d F Y", strtotime($note['created_at']));
        }

        return $notes;
    }

    public static function createNote($title, $description, $employeeId, $clientId){

        $pdo = getDatabaseConnection(); 
        $query = "INSERT INTO note (title, content, employee_id, client_id, created_at)
                  VALUES (:title, :content, :employee_id, :client_id, NOW())";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'title' => $title,
            'content' => $description,
            'employee_id' => $employeeId,
            'client_id' => $clientId
        ]);
        return true;

    }
    public static function updateFavouriteStatus($noteId, $fav){

        $pdo = getDatabaseConnection(); 
        $query = "UPDATE note SET fav = :fav WHERE id = :noteId";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'noteId' => $noteId,
            'fav' => $fav
        ]);
        return true;

    }
    public static function deleteNoteById($noteId){

        $pdo = getDatabaseConnection(); 
        $query = "UPDATE note SET active = 0 WHERE id = :noteId";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'noteId' => $noteId
        ]);
        return true;

    }
}

