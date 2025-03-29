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
            <h1 class="display-4">Mise en place<br> d'une salle<br></h1>
            <small><font color="red">*</font> Ces données sont obligatoires pour la création d'une salle.</small>

            <form action="/Projet-Annuel-2i1/PA2i1/api/ApiRoom.php" method="POST">

                <div class="form-group">
                    <label for="company_name"> Nom de la salle (ou numéro) :</label>
                    <input type="text" name="name" id="name" class="form-control" value="Salle ">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Capacité de la salle :</label>
                    <input type="text" name="capacity" id="capacity" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Adresse :</label>
                    <input type="text" name="address" id="address" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Code postal :</label>
                    <input type="text" name="postal_code" id="postal_code" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Ville :</label>
                    <input type="text" name="city" id="city" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Pays :</label>
                    <input type="text" name="country" id="country" required class="form-control">
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