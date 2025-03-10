<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '\Projet-Annuel-2i1\PA2i1\views\admin\back\dao\DAOCv.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $dao = new DAOCv();
    
    $cv = $dao->getUserCvById($id);

    if ($cv) {
        echo json_encode(['status' => 'success', 'cv' => $cv]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Fichier non trouvé.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID manquant.']);
}
?>
