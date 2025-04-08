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
            <h1 class="display-4">Création de <br> Devis<br></h1>
            <small><font color="red">*</font> Ces données sont obligatoires pour la création d'un devis.</small>

            <form action="/Projet-Annuel-2i1/PA2i1/api/ApiDevis.php" method="POST">

                <div class="form-group">
                    <label for="company_name"> Nom du devis (visible uniquement pour vous) :</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Titre du devis</label>
                    <input type="text" name="title"id="title" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Descrition du devis</label>
                    <br><small>Veuillez indiquer l'évènement que vous voulez mettre en place pour vos employés</small>
                    <textarea type="text" name="description" id="description" required class="form-control">   </textarea>
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