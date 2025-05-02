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
        <section id="heroBanner-login">
    <div class="container-xl">
        <div class="row" style="width: 1000px;">
        <div class="col-lg">

            <div class="jumbotron bg-white">
            <h1 class="display-4">Création d'une <br> Demande<br></h1>
            <small><font color="red">*</font> Ces données sont obligatoires pour la création d'un devis.</small>

            <form action="/Projet-Annuel-2i1/PA2i1/api/ApiDevis.php" method="POST">

                <div class="form-group">
                    <label for="name">Nom de la demande :</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="title"><font color="red">*</font> Titre de la demande :</label>
                    <input type="text" name="title" id="title" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="description"><font color="red">*</font> Description de la demande :</label>
                    <br><small>Veuillez indiquer l'événement que vous voulez mettre en place pour vos employés.</small>
                    <textarea name="description" id="description" required class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label><font color="red">*</font> S'agit-il d'un rendez-vous médical ?</label><br>
                    <input type="checkbox" name="is_medical" id="is_medical" value="1">
                    <label for="is_medical">Oui</label>
                </div>

                <div class="form-group">
                    <label><font color="red">*</font> Lieu du rendez-vous :</label><br>
                    <input type="radio" name="location" id="on_site" value="on_site" required>
                    <label for="on_site">Locaux de l'entreprise</label><br>
                    <input type="radio" name="location" id="business_care" value="business_care">
                    <label for="business_care">Chez Business Care</label>
                </div>

                <div class="form-group">
                    <label for="capacity"><font color="red">*</font> Capacité maximale de l'événement :</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" min="1" required>
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