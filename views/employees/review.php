<?php
 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/middlewares/AuthMiddleware.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/models/UserModel.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/Controllers/AuthController.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/routes/web.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use Middleware\AuthMiddleware;
use Controllers\AuthController;
if (!AuthMiddleware::checkAccess('employees')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}

// $router->dispatch();

// Inclure le fichier de configuration de la base de données
include('includes/db.php');


// Récupérer les données du formulaire
$note = $_POST['note'];
$commentaire = $_POST['commentaire'];

// Vérifier si les données sont valides
if (!empty($note) && !empty($commentaire)) {
    // Récupérer l'ID de l'utilisateur à partir de la session
    $utilisateur_id = $_SESSION['id'];
    
    // Récupérer l'ID du cours à partir des données GET ou du formulaire
    if (isset($_GET['id_cours'])) {
        $cours_id = $_GET['id_cours'];
    } else {
        // Redirection vers une page d'erreur si l'ID du cours n'est pas fourni
        header("Location: module.php?message=Une donnée est manquante veuillez réessayer !&type=warning");
        exit;
    }
    
    // Préparer la commande SQL pour insérer la review dans la base de données
    $query = "INSERT INTO review (date, note, avis, id_cours, id_user) VALUES (NOW(), :note, :avis, :id_cours, :id_user)";
    $stmt = $bdd->prepare($query);

    // Exécuter la commande SQL en liant les valeurs aux paramètres
    $result = $stmt->execute([
        'note' => $note,
        'avis' => $commentaire,
        'id_cours' => $cours_id,
        'id_user' => $utilisateur_id
    ]);

    
    // Vérifier si l'insertion a réussi
    if ($result) {
        // Redirection vers une page de succès
        header("Location: module.php?message=Avis ajouté merci !&type=success");
        exit;
    } else {
        // Redirection vers une page d'erreur
        header("Location: module.php?message=Une donnée est manquante veuillez réessayer !&type=warning");
        exit;
    }
} else {
    // Redirection vers une page d'erreur si les données sont manquantes
    header("Location: module.php?message=Une donnée est manquante veuillez réessayer !&type=warning");
    exit;
}

?>
