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
if (!AuthMiddleware::checkAccess('admin')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../includes/head.php'); ?>
    <link href="../../assets/styles/accountHome.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <main>
        
        <section class="hero-welcome">
            <div class="container">
                <h1>Bienvenue <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['name']; ?> !</h1>
                <div class="hero-line"></div>
                <h4>Vous êtes connecté(e) en tant qu’<strong><?php echo $_SESSION['role']; ?></strong>.</h4>
            </div>
        </section>

   
        <section class="dashboard-section py-5">
            <div class="container-md">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Panneau de contrôle</h2>
                    <p class="text-muted">Accès rapide aux outils de gestion de la plateforme</p>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    <div class="col">
                        <div class="card dashboard-card text-center p-4">
                            <i class="bi bi-people mb-3"></i>
                            <h5 class="card-title">Utilisateurs</h5>
                            <p class="text-muted">Gérez les comptes employés, clients et prestataires.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Gérer les utilisateurs</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card dashboard-card text-center p-4">
                            <i class="bi bi-calendar-event mb-3"></i>
                            <h5 class="card-title">Événements</h5>
                            <p class="text-muted">Créez, modifiez ou supprimez les événements de l’entreprise.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Voir le calendrier</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card dashboard-card text-center p-4">
                            <i class="bi bi-bar-chart-line mb-3"></i>
                            <h5 class="card-title">Statistiques</h5>
                            <p class="text-muted">Suivez les indicateurs clés de performance interne.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Accéder aux stats</a>
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
