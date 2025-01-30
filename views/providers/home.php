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
if (!AuthMiddleware::checkAccess('providers')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}

// $router->dispatch();
?>


<!DOCTYPE html>
<html lang="fr">

    <? include('../includes/head.php'); ?>

    <body>
        
        <? include('includes/header.php'); ?>
        
        <main>
            <section id="heroBanner-login">
                <div class="container-xl">
                    <div class="row">
                    <div class="col-lg">
                        <div class="jumbotron bg-white">
                        <h1 class="display-4">Bienvenue <br> <?echo $_SESSION['firstname'];?>&nbsp<? echo $_SESSION['name'] ?></h1>
                        <h4 class="display-4">Vous êtes connectés en tant qu' <?echo $_SESSION['role'];?></h4>
                        </div>

                    </div>
                </div>
            </section>
        </main>

    </body>
</html>
