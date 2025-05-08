<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class EventDAO {
    
    public static function getUserEvents($userId) {
        $db = getDatabaseConnection();

        $sql = "SELECT id_event FROM reservation WHERE id_user = :id_user";
        $req = $db->prepare($sql);
        $req->execute(['id_user' => $userId]);
        $inscris = $req->fetchAll(PDO::FETCH_COLUMN, 0);

        if (empty($inscris)) {
            return [];
        }

        $ids = implode(',', array_map('intval', $inscris));
        if (empty($ids)) {
            return [];
        }

        $sql = "SELECT title AS title, start_date AS start_date, end_date AS end_date, 
                       TIME_FORMAT(start_hour, '%H:%i') AS heure_debut, 
                       TIME_FORMAT(end_hour, '%H:%i') AS heure_fin 
                FROM event WHERE id IN ($ids)";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as &$event) {
            $event['start'] = $event['start_date'] . 'T' . date("H:i", strtotime($event['heure_debut']));
            $event['end'] = $event['end_date'] . 'T' . date("H:i", strtotime($event['heure_fin']));
            unset($event['start_date'], $event['heure_debut'], $event['heure_fin']);
        }

        return $events;
    }
    public static function getProvidersEvents($userId) {
        $db = getDatabaseConnection();
    
        $sql = "SELECT c.id_event 
        FROM contracts c
        INNER JOIN providers p ON c.id_provider = p.id
        WHERE p.user_id = :id_user 
          AND c.active = 2 
          AND c.status = 5";
        $req = $db->prepare($sql);
        $req->execute(['id_user' => $userId]);
        $inscris = $req->fetchAll(PDO::FETCH_COLUMN);
    
        if (empty($inscris)) {
            return [];
        }
    
        $ids = implode(',', array_map('intval', $inscris));
    
        $sql = "SELECT title AS title, start_date AS start_date, end_date AS end_date, 
                       TIME_FORMAT(start_hour, '%H:%i') AS heure_debut, 
                       TIME_FORMAT(end_hour, '%H:%i') AS heure_fin 
                FROM event 
                WHERE id IN ($ids)";
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
    
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($events as &$event) {
            $event['start'] = $event['start_date'] . 'T' . $event['heure_debut'];
            $event['end'] = $event['end_date'] . 'T' . $event['heure_fin'];
            unset($event['start_date'], $event['heure_debut'], $event['heure_fin']);
        }
    
        return $events;
    }
    

    public static function getEmployeesEvents($userId) {
        $db = getDatabaseConnection();

        $sql = "SELECT id_event FROM reservation WHERE id_user = :id_user";
        $req = $db->prepare($sql);
        $req->execute(['id_user' => $userId]);
        $inscris = $req->fetchAll(PDO::FETCH_COLUMN, 0);

        if (empty($inscris)) {
            return [];
        }

        $ids = implode(',', array_map('intval', $inscris));
        if (empty($ids)) {
            return [];
        }

        $sql = "SELECT title AS title, start_date AS start_date, end_date AS end_date, 
                       TIME_FORMAT(start_hour, '%H:%i') AS heure_debut, 
                       TIME_FORMAT(end_hour, '%H:%i') AS heure_fin 
                FROM event WHERE id IN ($ids)";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as &$event) {
            $event['start'] = $event['start_date'] . 'T' . date("H:i", strtotime($event['heure_debut']));
            $event['end'] = $event['end_date'] . 'T' . date("H:i", strtotime($event['heure_fin']));
            unset($event['start_date'], $event['heure_debut'], $event['heure_fin']);
        }

        return $events;
    }
    public static function getEmployeePlanningForAndroid(int $userId): array {
        $db = getDatabaseConnection();

        $sql = "
            SELECT 
                e.title,
                DATE_FORMAT(e.start_date, '%Y-%m-%d')     AS date,
                TIME_FORMAT(e.start_hour, '%H:%i')        AS start_time,
                TIME_FORMAT(e.end_hour,   '%H:%i')        AS end_time
            FROM reservation r
            INNER JOIN event e   ON r.id_event = e.id
            WHERE r.id_user = :uid
              AND e.active = 1
            ORDER BY e.start_date, e.start_hour
        ";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
