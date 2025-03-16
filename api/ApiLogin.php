<?php
session_start(); 

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/stringUtils.php';

header("Content-Type: application/json");

if (!methodIsAllowed('login')) {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = getBody();
if (!verifyMandatoryParams($data, ['username', 'password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Mandatory parameters: username, password']);
    exit;
}

$username = trim($data['username']);
$password = trim($data['password']);
$passwordHashed = hash('sha512', $password);

$users = findUsersByCredentials($username, $passwordHashed);
if (!$users) {
    http_response_code(401);
    echo json_encode(['error' => 'Identifiants invalides']);
    exit;
}

if (isset($users['active']) && $users['active'] == 0) {
    http_response_code(403);
    echo json_encode(['error' => 'Votre compte a été suspendu. Veuillez contacter l’administrateur.']);
    exit;
}

$usersId = $users['id'];
$token = date('d/M/Y H:i:s') . '_' . $usersId . '_' . generateRandomString(100);
$tokenHashed = hash('md5', $token);

$res = setUsersSession($usersId, $tokenHashed);
if (!$res) {
    http_response_code(500);
    echo json_encode(['error' => 'Une erreur interne est survenue.']);
    exit;
}

if (!isset($users['id_clients']) && !isset($users['id_providers']) && !isset($users['id_admin']) && isset($users['id_employees'])) {
    $user['role'] = 'employees'; 
} elseif (!isset($users['id_clients']) && !isset($users['id_providers']) && !isset($users['id_employees']) && isset($users['id_admin'])) {
    $user['role'] = 'admin';
} elseif (!isset($users['id_clients']) && !isset($users['id_admin']) && !isset($users['id_employees']) && isset($users['id_providers'])) {
    $user['role'] = 'providers';
} elseif (!isset($users['id_providers']) && !isset($users['id_admin']) && !isset($users['id_employees']) && isset($users['id_clients'])) {
    $user['role'] = 'clients';
} else {
    $user['role'] = 'unknown';
}

$_SESSION['token'] = $tokenHashed;
$_SESSION['username'] = $users['username'];
$_SESSION['name'] = $users['name'];
$_SESSION['firstname'] = $users['firstname'];
$_SESSION['role'] = $user['role'];
$_SESSION['id'] = $users['id'];
$_SESSION['img'] = $users['img'];

echo json_encode([
    'token' => $tokenHashed,
    'role' => $user['role'], 
    'id' => $users['id'],
    'username' => $users['username'],
    'name' => $users['name'],
    'firstname' => $users['firstname'],
    'date' => date('Y-m-d H:i:s', strtotime('+1 hour')),
    'active' => $users['active'],
]);
exit;
