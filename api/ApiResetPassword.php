<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email'], $data['newPassword'])) {
        $email = $data['email'];
        $newPassword = trim($data['newPassword']);
        $passwordHashed = hash('sha512', $newPassword);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/user.php';
        $result = resetPasswordByEmail($email, $passwordHashed);

        if ($result) {
            echo json_encode(['success' => 'Mot de passe modifié avec succès.']);
            exit;
        } else {
            echo json_encode(['error' => 'Erreur lors de la réinitialisation du mot de passe.']);
            exit;
        }
    } else {
        echo json_encode(['error' => 'Données incomplètes']);
        exit;
    }
}
?>
