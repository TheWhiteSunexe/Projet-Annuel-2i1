<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class CourseEventDAO {
    public static function getEventDates() {
        $db = getDatabaseConnection();
        $query = "SELECT date FROM event ORDER BY date ASC LIMIT 3";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getCourseEvents() {
        $db = getDatabaseConnection();
        $query = "SELECT id, title, description, description, date, start_hour, end_hour, place 
                  FROM event 
                  ORDER BY date, start_hour";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
