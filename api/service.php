<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/UserDAO.php';

function checkProviders() {

$userId = $_SESSION['id'];
$statutArray = DAOUser::checkStatutProvider($userId);
$statut = $statutArray['statut'];
$_SESSION['statut'] = $statut;

}

