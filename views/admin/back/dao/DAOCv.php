<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\Projet-Annuel-2i1\PA2i1\views\admin\back\dao\utils\database.php';

class DAOCv {
    
    private $pdo;

    public function __construct() {
        $this->pdo = getDatabaseConnection();
    }

    public function getUserCvById($userId) {
        try {
            $q = 'SELECT p.cv FROM providers p INNER JOIN users u ON p.user_id = u.id WHERE u.id = :id';
            $stmt = $this->pdo->prepare($q);
            $stmt->execute(['id' => $userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['cv'] : null;
        } catch (PDOException $e) {
            return null;
        }
    }
}
?>
