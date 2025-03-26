<?php
session_start();
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOContracts.php';

$contracts = ContractDAO::getAllContracts();
echo json_encode($contracts);
