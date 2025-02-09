<?php
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/eventDAO.php';

$events = CourseEventDAO::getCourseEvents();
echo json_encode($events);
