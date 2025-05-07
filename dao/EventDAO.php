<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class CourseEventDAO {
    public static function getEventDates($id) {
        $db = getDatabaseConnection();
        $query = "SELECT start_date 
                  FROM event 
                  WHERE id_company = :id AND active = 1
                  ORDER BY start_date ASC 
                  LIMIT 3";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public static function getUserCompanyId($id) {
        $db = getDatabaseConnection();
        $query = "SELECT id_enterprise
                  FROM employees 
                  WHERE id_users = :id";
        $stmt = $db->prepare($query); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn(); 
    }
    
    public static function getCourseEvents($id) {
        $db = getDatabaseConnection();
        $query = "SELECT e.id, e.title, e.description, e.start_date AS date, e.start_hour, e.end_hour, e.id_room, 
                         r.name, r.address, r.postal_code, r.city, r.country,
                         u.name, u.firstname
                  FROM event e 
                  INNER JOIN room r ON e.id_room = r.id
                  INNER JOIN contracts c ON e.id_contract = c.id
                  INNER JOIN providers p ON c.id_provider = p.id
                  INNER JOIN users u ON p.user_id = u.id
                  WHERE e.id_company = :id AND e.active = 1
                  ORDER BY e.start_date ASC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    public static function reserveEvent($userId, $eventId) {
        $db = getDatabaseConnection();
    
        $query = "SELECT active
        FROM reservation
        WHERE id_user = :userId AND id_event = :eventId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $existingReservationStatus = $stmt->fetchColumn();

        // Si la reservation existe et est active, on renvoie une erreur
        if ($existingReservationStatus === '1') {
        return false; // Réservation déjà active
        }
        // Si la reservation existe et est inactive, on reactive la reservation
        elseif ($existingReservationStatus === '0') {
        // Mettre a jour la réservation pour la reactiver
        $query = "UPDATE reservation
                    SET active = 1
                    WHERE id_user = :userId AND id_event = :eventId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();

        return true; // reservation réactivée 
        }
        // Si la reservation n'existe pas on la créer
        else {
        // Vérifier le nombre actuel de participants et la limite des participants
        $query = "SELECT COUNT(*) 
                    FROM reservation
                    WHERE id_event = :eventId AND active = 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $currentParticipants = $stmt->fetchColumn();

        // Récuperation de la limite des participants de l'evenement
        $query = "SELECT participant
                    FROM event
                    WHERE id = :eventId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $maxParticipants = $stmt->fetchColumn();

            // Vérification de si le nombre de participants est inferieur à la limite OU si aucune limite n'est définie
            if ($maxParticipants === NULL || $currentParticipants < $maxParticipants) {
                $query = "INSERT INTO reservation (id_user, id_event, active)
                            VALUES (:userId, :eventId, 1)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
                $stmt->execute();

                return true;
            } else {
                return false; // Nombre de participants max atteint
            }
        }
    }
    
    
    public static function unreserveEvent($userId, $eventId) {
        $db = getDatabaseConnection();
    
        $query = "UPDATE reservation
                  SET active = 0
                  WHERE id_user = :userId AND id_event = :eventId AND active = 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
    
        return true;
    }
    
    
}
