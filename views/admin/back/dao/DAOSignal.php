<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DAOSignal {

    public static function getSignalements($type) {
        $conn = getdatabaseconnection();

        $stmt = $conn->prepare("
            SELECT r.id, r.content, r.screen, r.date, rt.content AS type_content
            FROM reporting r
            JOIN reporting_type rt ON r.type_signal = rt.id
            WHERE r.type_signal = :type AND r.active != 0
        ");

        $stmt->bindParam(':type', $type, PDO::PARAM_INT); 
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function resolveReporting($id) {
        try {
            $pdo = getDatabaseConnection();
            $query = "UPDATE reporting SET active = '0' WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function createReporting($id) {
        try {
            $pdo = getDatabaseConnection();
            
            $query = "SELECT u.name, u.firstname, u.email, fc.contenu, fc.date_creation
                      FROM users u
                      INNER JOIN forum_commentaires fc 
                      ON fc.commentaire_id = :id
                      WHERE fc.utilisateur_id = u.id";
        
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                $name = $result['name'];
                $firstname = $result['firstname'];
                $email = $result['email'];
                $content = $result['contenu'];
                $date = $result['date_creation'];
                
                $sentence = "Signalement automatique : $name $firstname ($email), membre de votre entreprise, a été signalé pour des propos dans le forum le $date, '$content'";
    
                $query = "INSERT INTO reporting (type_signal, content) VALUES (4, :sentence)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':sentence', $sentence, PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                    return true; 
                } else {
                    return 'Erreur lors de l\'insertion du signalement dans la base de données.';
                }
            } else {
                return 'Aucun commentaire trouvé avec l\'ID spécifié.';
            }
            
        } catch (PDOException $e) {
            return 'Erreur lors de la création du signalement : ' . $e->getMessage();
        }
    }
    
    
    
    
}
