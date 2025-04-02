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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../includes/head.php'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/styles/accountHome.css">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <main>
    
        <section class="hero-welcome">
            <div class="container">
                <h1>Bienvenue <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['name']; ?> !</h1>
                <div class="hero-line"></div>
                <h4>Vous êtes connecté(e) en tant que <strong><?php echo $_SESSION['role']; ?></strong>.</h4>
            </div>
        </section>


        <section class="dashboard-section py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Accès rapide</h2>
                    <p class="text-muted">Voici vos outils principaux à portée de clic</p>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    <div class="col">
                        <div class="card dashboard-card text-center p-4">
                            <i class="bi bi-calendar-event mb-3"></i>
                            <h5 class="card-title">Mes rendez-vous</h5>
                            <p class="text-muted">Consultez, modifiez ou annulez vos rendez-vous facilement.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Voir mes rendez-vous</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card dashboard-card text-center p-4">
                            <i class="bi bi-envelope-open-text mb-3"></i>
                            <h5 class="card-title">Messages & Support</h5>
                            <p class="text-muted">Discutez avec notre équipe ou envoyez une demande de support.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Contacter le support</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card dashboard-card text-center p-4">
                            <i class="bi bi-file-earmark-text mb-3"></i>
                            <h5 class="card-title">Factures & contrats</h5>
                            <p class="text-muted">Accédez à vos documents contractuels et vos factures.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Voir mes documents</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer>
            <div class="container text-center">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <h5>Business Care</h5>
                        <p>110, rue de Rivoli, Paris</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Navigation</h5>
                        <a href="#">Accueil</a> |
                        <a href="#services">Services</a> |
                        <a href="login.php">Connexion</a>
                    </div>
                    <div class="col-md-4">
                        <h5>Contact</h5>
                        <p>contact@businesscare.fr<br>+33 1 23 45 67 89</p>
                        <div class="social-icons mt-2">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>
                </div>
                <p class="mb-0">&copy; 2025 Business Care — Tous droits réservés. <a href="#">Mentions légales</a></p>
            </div>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
