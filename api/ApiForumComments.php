<?php
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/ForumDAO.php';

$messages = ForumMessageDAO::getRecentMessages(5);

echo json_encode($messages);