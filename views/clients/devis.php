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
if (!AuthMiddleware::checkAccess('clients')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}

// $router->dispatch();
?>
<!DOCTYPE html>
<html lang="fr">

<?php include('../includes/head.php'); ?>

    <body>
    <?php include('includes/header.php'); ?>

    <main style="padding-left: 20px;  padding-right: 20px;">
        <h1 class="display-4">Gestion des Devis</h1>
        <button onclick="addDevis()"class="btn btn-primary profile-button">Créer un devis</button>
    <div>     
        <div id="result">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom du Devis</th>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Progression</th>
                        <th>Situation</th>
                        <th>Téléchargement</th>
                    </tr>
                </thead>
                <tbody id="contractTableBody">
                </tbody>
            </table>
        </div>
    </div>
</main>
    </body>
    <script src="script/devis.js"></script>
</html>