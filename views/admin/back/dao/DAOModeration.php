<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\Projet-Annuel-2i1\PA2i1\views\admin\back\dao\utils\database.php';

class DAOModeration {

    private $pdo;

    public function __construct() {
        $this->pdo = getDatabaseConnection(); 
    }

    public function getAllModerations() {
        try {
            $query = "
                SELECT 
                    fc.commentaire_id,
                    fc.active,
                    fc.contenu AS commentaire_contenu,
                    fc.date_creation AS commentaire_date,
                    u.id AS utilisateur_id,
                    u.username AS utilisateur_nom,
                    fm.message_id,
                    fm.titre AS sujet_titre
                FROM forum_commentaires fc
                INNER JOIN users u ON fc.utilisateur_id = u.id  -- Correction ici !
                INNER JOIN forum_messages fm ON fc.message_id = fm.message_id  -- Correction ici aussi !
                ORDER BY fc.date_creation DESC;

            ";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function updateActiveStatus($moderationId, $status) {
        try {
            $query = "
                UPDATE forum_commentaires
                SET active = :active
                WHERE commentaire_id = :moderationId
            ";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':active', $status, PDO::PARAM_INT);
            $stmt->bindParam(':moderationId', $moderationId, PDO::PARAM_INT);
            
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la mise à jour du statut: ' . $e->getMessage()];
        }
    }
}
?>
