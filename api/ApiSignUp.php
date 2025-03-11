<?php

header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/SignUpDAO.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['type'])) {
    echo json_encode(['success' => false, 'error' => 'Le type d\'inscription est requis.']);
    exit;
}

$type = strtolower(trim($data['type'])); 

if ($type === 'client') {
    if (!isset(
        $data['company_name'], 
        $data['siret_number'], 
        $data['legal_form'], 
        $data['activity_sector'], 
        $data['representative_lastname'], 
        $data['representative_firstname'], 
        $data['contact_email'], 
        $data['contact_phone'], 
        $data['company_website'], 
        $data['billing_address'], 
        $data['postal_code'], 
        $data['country'], 
        $data['password'], 
        $data['confirm_password']
    )) {
        echo json_encode(['success' => false, 'error' => 'Données manquantes pour l\'inscription client.']);
        exit;
    }
}

if ($type === 'provider') {
    if (!isset(
        $data['lastname'], 
        $data['firstname'], 
        $data['email'], 
        $data['phone'], 
        $data['service_type'], 
        $data['service_description'], 
        $data['billing_address'], 
        $data['postal_code'], 
        $data['country'], 
        $data['password'], 
        $data['confirm_password']
    )) {
        echo json_encode(['success' => false, 'error' => 'Données manquantes pour l\'inscription prestataire.']);
        exit;
    }
}

if ($data['password'] !== $data['confirm_password']) {
    echo json_encode(['success' => false, 'error' => 'Les mots de passe ne correspondent pas.']);
    exit;
}

$email = $data['contact_email'] ?? $data['email'];
if (UserDAO::emailExists($email)) {
    echo json_encode(['success' => false, 'error' => 'Cet email est déjà utilisé.']);
    exit;
}

$password_hashed = hash('sha512', trim($data['password']));

$success = false;
if ($type === 'client') {
    $success = UserDAO::createClient(
        $data['company_name'],
        $data['siret_number'],
        $data['legal_form'] ?? null,
        $data['activity_sector'] ?? null,
        $data['representative_lastname'],
        $data['representative_firstname'],
        $data['contact_email'],
        $data['contact_phone'],
        $data['company_website'] ?? null,
        $data['billing_address'],
        $data['postal_code'],
        $data['country'],
        $password_hashed
    );
} else if ($type === 'provider') {
    $success = UserDAO::createProvider(
        $data['lastname'],
        $data['firstname'],
        $data['email'],
        $data['phone'],
        $data['service_type'],
        $data['service_description'],
        $data['billing_address'],
        $data['postal_code'],
        $data['country'],
        $data['company_name'] ?? null,
        $data['siret'] ?? null,
        $data['vat_number'] ?? null,
        $data['website'] ?? null,
        $password_hashed
    );
} else {
    echo json_encode(["success" => false, "error" => "Type d'inscription invalide."]);
    exit;
}

if ($success === true) {
    echo json_encode(["success" => true, "message" => "Inscription réussie"]);
} else {
    echo json_encode(["success" => false, "error" => $success]);
}
?>
