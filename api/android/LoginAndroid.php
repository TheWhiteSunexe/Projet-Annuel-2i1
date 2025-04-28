<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/user.php';

header("Content-Type: application/json");

// Vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée. Utilisez POST.']);
    exit();
}

// Récupération des données POST
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');


if (!$username || !$password) {
    echo json_encode(['success' => false, 'message' => 'Nom d\'utilisateur et mot de passe requis.']);
    exit();
}

// Hash du mot de passe comme dans l'API existante
$hashedPassword = hash("sha512", $password);

try {
    $user = findUsersByCredentials($username, $hashedPassword);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Identifiants incorrects.']);
        exit();
    }

    // Vérifier que c'est bien un "employee"
    if (is_null($user['id_employees'])) {
        echo json_encode(['success' => false, 'message' => 'Accès réservé aux employés.']);
        exit();
    }

    // Vérifier si le compte est activé
    if (!$user['active']) {
        echo json_encode(['success' => false, 'message' => 'Compte non activé.']);
        exit();
    }

    // Réponse simplifiée pour l'app mobile
    echo json_encode([
        'success' => true,
        'message' => 'Connexion réussie',
        'user' => [
            'id'        => $user['id'],
            'username'  => $user['username'],
            'name'      => $user['name'],
            'firstname' => $user['firstname'],
            'img'       => $user['img']
        ]
    ]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
    exit();
}
