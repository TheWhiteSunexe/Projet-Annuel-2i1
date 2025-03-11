<?php
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOSignal.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $type = $_GET['type'] ?? null;

    if ($type) {
        $signalements = DAOSignal::getSignalements($type);

        if ($signalements) {
            echo json_encode([
                'success' => true,
                'data' => $signalements
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => "Aucun signalement trouvé pour ce type."
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'error' => "Le type de signalement est requis."
        ]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action =  $data['action'] ?? null;
    $signalementId = $data['id'] ?? null;

    if (!$signalementId) {
        echo json_encode([
            'success' => false,
            'error' => "L'ID du signalement est requis."
        ]);
        exit;
    }

    if ($action === 'resolve') {
        $result = DAOSignal::resolveReporting($signalementId);
        if ($result === true) {
            $message = "Signalement $signalementId résolu avec succès.";
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la résolution."
            ]);
        }
    } elseif ($action === 'create') {
        $result = DAOSignal::createReporting($signalementId);
        if ($result === true) {
            $message = "Signalement $signalementId créé avec succès.";
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => $result ?: "Une erreur inconnue s'est produite lors de la création du signalement."
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'error' => "Action invalide."
        ]);
        exit;
    }
    
    exit;
}

echo json_encode([
    'success' => false,
    'error' => "Méthode non autorisée."
]);
?>
