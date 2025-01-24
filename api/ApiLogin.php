<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/stringUtils.php';
header("Content-Type: application/json");

if (!methodIsAllowed('login')) {
    returnError(405, 'Method not allowed');
}

$data = getBody();

if (!verifyMandatoryParams($data, ['username', 'password'])) {
    returnError(400, 'Mandatory parameters : username, password');
}

$username = trim($data['username']);
$password = trim($data['password']);
$passwordHashed = hash('sha512', $password);

$viking = findUsersByCredentials($username, $passwordHashed);
if (!$viking) {
    returnError(401, 'Invalid credentials');
}
$vikingId = $viking['id'];

$token = date('d/M/Y h:m:s') . '_' . $vikingId . '_' . generateRandomString(100);
$tokenHashed = hash('md5', $token);

$res = setUsersSession($vikingId, $tokenHashed);
if (!$res) {
    returnError(500, 'An error has occurred');
}

returnSuccess(
    [
        'token' => $tokenHashed,
        'date' => date_add(
            date_create(),
            DateInterval::createFromDateString('1 hour')
        )
    ]
);