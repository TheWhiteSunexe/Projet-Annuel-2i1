<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/EventDAO.php';

class CalendarController {
    public static function getEventsJSON() {
        session_start();
        if (!isset($_SESSION['id'])) {
            return json_encode([]);
        }
        return json_encode(EventDAO::getUserEvents($_SESSION['id']));
    }
}
