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

        $sql = "SELECT title AS title, date AS start_date, 
                       TIME_FORMAT(start_hour, '%H:%i') AS heure_debut, 
                       TIME_FORMAT(end_hour, '%H:%i') AS heure_fin 
                FROM event WHERE id IN ($ids)";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as &$event) {
            $event['start'] = $event['start_date'] . 'T' . date("H:i", strtotime($event['heure_debut']));
            $event['end'] = $event['start_date'] . 'T' . date("H:i", strtotime($event['heure_fin']));
            unset($event['start_date'], $event['heure_debut'], $event['heure_fin']);
        }

        return $events;
    }
}
