<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $cvFile = getCvFile($id);

    if ($cvFile && file_exists($_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/uploads/' . $cvFile)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream'); 
        header('Content-Disposition: attachment; filename="' . basename($cvFile) . '"'); 
        header('Expires: 0');
        header('Cache-Control: must-revalidate'); 
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $cvFile)); 
        flush(); 
        readfile('uploads/' . $cvFile);
        exit;
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Fichier non trouvé.";
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "ID de l'utilisateur manquant.";
}

function getCvFile($userId) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/Projet-Annuel-2i1/PA2i1/views/admin/back/api/ApiGetCv.php?id=' . $userId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($data['status'] === 'success') {
        return $data['cv'];
    } else {
        return null;
    }
}
?>
