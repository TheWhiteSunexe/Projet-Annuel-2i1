<?php
/* PAS NECESSAIRE CAR index.php EST PUBLIC ET NON PRIVE EN FONCTION DES ROLES
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/middlewares/AuthMiddleware.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/models/UserModel.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/Controllers/AuthController.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/routes/web.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use Middleware\AuthMiddleware;
use Controllers\AuthController;
if (!AuthMiddleware::checkAccess('client')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}*/

// $router->dispatch();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../assets/styles/bootstrap-4.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/header.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
    
    <title>Business Care</title>
      <link rel="icon" type="image/png" href="../assets/images/logoSmall.png">
  </head>
  <body>
      <header>
        <div class="container-xl">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand" href="login.php">
                <img width="40" height="40" src="../assets/images/logoSmall.png" alt="Small Logo">

                    Business Care</a>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <?php
                    
                    if (isset($_SESSION['role'])) {
                        echo '<a href="/Projet-Annuel-2i1/PA2i1/views/logout.php"><button class="btn btn-round btn-danger">Se déconnecter</button></a>';
                    } else {
                        echo '<a href="/Projet-Annuel-2i1/PA2i1/views/login.php"><button class="btn btn-round btn-success">Se connecter</button></a>';
                    }
                    ?>
                </div>
          </nav>
        </div>
      </header>
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
