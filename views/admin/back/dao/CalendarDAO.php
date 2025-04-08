<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class EventDAO {
    
    public static function getAllEvents() {
        $db = getDatabaseConnection();

        $sql = "SELECT  r.name AS title, e.start_date AS start_date, e.end_date AS end_date, TIME_FORMAT(e.start_hour, '%H:%i') AS heure_debut, TIME_FORMAT(e.end_hour, '%H:%i') AS heure_fin
                FROM room r
                INNER JOIN event e
                ON r.id = e.id_room
                WHERE r.active = 1
         ";

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
}
