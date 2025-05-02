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
?>
<!DOCTYPE html>
<html lang="fr">

<?php include('../includes/head.php'); ?>

    <body>
    <?php include('includes/header.php'); ?>

    <main style="padding-left: 20px;  padding-right: 20px;">
        <section id="heroBanner-login">
    <div class="container-xl">
        <div class="row" style="width: 1000px;">
        <div class="col-lg">

            <div class="jumbotron bg-white">
            <h1 class="display-4">Création d'un <br> Sujet<br></h1>

            <form action="/Projet-Annuel-2i1/PA2i1/api/ApiForum.php" method="POST">

                <div class="form-group">
                    <label for="name">Titre du sujet de la discussion</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>

                <div id="error_message" style="color: red;"></div>
            </form>

            </div>
        </div>
    </div>
  </div>
</section>
</main>
    </body>
    <script src="script/devis.js"></script>
</html>