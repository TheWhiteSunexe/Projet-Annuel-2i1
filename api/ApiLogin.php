<?php
session_start(); 

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/stringUtils.php';

header("Content-Type: application/json");

if (!methodIsAllowed('login')) {
    returnError(405, 'Method not allowed');
}

$data = getBody();

if (!verifyMandatoryParams($data, ['username', 'password'])) {
    returnError(400, 'Mandatory parameters: username, password');
}

$username = trim($data['username']);
$password = trim($data['password']);
$passwordHashed = hash('sha512', $password);

$users = findUsersByCredentials($username, $passwordHashed);
if (!$users) {
    returnError(401, 'Invalid credentials');
}

$usersId = $users['id'];
$token = date('d/M/Y H:i:s') . '_' . $usersId . '_' . generateRandomString(100);
$tokenHashed = hash('md5', $token);

$res = setUsersSession($usersId, $tokenHashed);
if (!$res) {
    returnError(500, 'An error has occurred');
}

// if (!isset($users['id_clients']) && !isset($users['id_providers']) && !isset($users['id_admin'])) {
//     $users['role'] = 'employees'; 
// } elseif (!isset($users['id_clients']) && !isset($users['id_providers'])) {
//     $users['role'] = 'admin';
// } elseif (!isset($users['id_clients']) && !isset($users['id_admin'])) {
//     $users['role'] = 'providers';
// } elseif (!isset($users['id_providers']) && !isset($users['id_admin'])) {
//     $users['role'] = 'clients';
// } else {
//     $users['role'] = 'unknown';
// }

if ( is_null($users['id_clients']) && is_null($users['id_providers']) && is_null($users['id_admin'])) {
    $user['role'] = 'employees'; 
} elseif (is_null($users['id_clients']) && is_null($users['id_providers']) && isset($users['id_admin'])) {
    $user['role'] = 'admin';
} elseif (is_null($users['id_clients']) && is_null($users['id_admin']) && isset($users['id_providers'])) {
    $user['role'] = 'providers';
} elseif (is_null($users['id_providers']) && is_null($users['id_admin']) && isset($users['id_clients'])) {
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

returnSuccess([
    'token' => $tokenHashed,
    'role' => $user['role'], 
    'id' => $users['id'],
    'username' => $users['username'],
    'name' => $users['name'],
    'firstname' => $users['firstname'],
    'date' => date('Y-m-d H:i:s', strtotime('+1 hour'))
]);
