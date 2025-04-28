<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/server.php';

function getDatabaseConnection(): PDO {
    try {
        //$host = 'localhost';
        $host = 'pa2i1-mysql';
        $db = 'PA2i1';
        $user = 'root';
        $pass = 'root';
        $port = '3306';
        return new PDO("mysql:host=$host;dbname=$db;port=$port", $user, $pass);
    } catch (PDOException $e) {
        returnError(500, 'Could not connect to the database. ' . $e->getMessage());
        die();
    }
}