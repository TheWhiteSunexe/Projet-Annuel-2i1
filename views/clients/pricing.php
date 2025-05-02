<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/middlewares/AuthMiddleware.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/models/UserModel.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/Controllers/AuthController.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/routes/web.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Middleware\AuthMiddleware;

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
    <link rel="stylesheet" href="../../assets/styles/style_pricing.css">
</head>
<body>
<?php include('includes/header.php'); ?>
<main>
<section class="section" id="pricing">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="title-box text-center">
                    <h3 class="title-heading mt-4">Grille tarifaire Business Care : </h3>
                    
                </div>
            </div>
        </div>


        <div class="row mt-5 pt-4">
            <div class="col-lg-4">
                <div class="pricing-box mt-4">
                    <i class="mdi mdi-account h1"></i>
                    <h4 class="f-20">Starter</h4>

                    <div class="mt-4 pt-2">
                        <p class="mb-2 f-18">Features</p>

                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Effectif de l'entreprise</b>
                            30 max</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Activités <small>(avec participation des prestataires de BusinessCare)</small></b>
                            2</p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Rendez-vous médicaux <small>(présentiel/visio)</small></b>
                           1</p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Rendez-vous médicaux supplémentaires <small>(aux frais du salariés)</small></b>
                            75€/rdv
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Accès au ChatBot</b>
                            6 Q/R
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Accès aux fiches pratiques BusinessCare</b>
                            illimité
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Conseils hebdomadaires</b>
                            non
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Évènements / Communautés <small>(sans intervention des prestataires de BusinessCare, évènements interne à l'entreprise)</small></b>
                        illimité
                        </p>
                    </div>
                    <div class="pricing-plan mt-4 pt-2">
                        <h4 class="text-muted"><s> 200€</s> <span class="plan pl-3 text-dark">180€ </span></h4>
                        <p class="text-muted mb-0">Annuel et par salarié</p>
                    </div>


                    <div class="mt-4 pt-3">
                        <a href="payment.php?id=1" class="btn btn-primary btn-rounded">Choisir </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="pricing-box mt-4">
                    <div class="pricing-badge">
                        <span class="badge">Best option</span>
                    </div>

                    <i class="mdi mdi-account-multiple h1 text-primary"></i>
                    <h4 class="f-20 text-primary">Basic</h4>


                    <div class="mt-4 pt-2">
                        <p class="mb-2 f-18">Features</p>

                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Effectif de l'entreprise</b>
                            250 max</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Activités <small>(avec participation des prestataires de BusinessCare)</small></b>
                            3</p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Rendez-vous médicaux <small>(présentiel/visio)</small></b>
                            2</p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Rendez-vous médicaux supplémentaires <small>(aux frais du salariés)</small></b>
                            75€/rdv
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Accès au ChatBot</b>
                            20 Q/R
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Accès aux fiches pratiques BusinessCare</b>
                        illimité
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Conseils hebdomadaires</b>
                        Oui (non personnalisés)
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Évènements / Communautés <small>(sans intervention des prestataires de BusinessCare, évènements interne à l'entreprise)</small></b>
                        illimité
                        </p>
                    </div>

                    <div class="pricing-plan mt-4 pt-2">
                        <h4 class="text-muted"><s> 180€</s> <span class="plan pl-3 text-dark">150€ </span></h4>
                        <p class="text-muted mb-0">Annuel et par salarié</p>
                    </div>

                    <div class="mt-4 pt-3">
                        <a href="payment.php?id=2" class="btn btn-primary btn-rounded">Choisir</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="pricing-box mt-4">
                    <i class="mdi mdi-account-multiple-plus h1"></i>
                    <h4 class="f-20">Premium</h4>


                    <div class="mt-4 pt-2">
                        <p class="mb-2 f-18">Features</p>

                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Effectif de l'entreprise</b>
                            +251</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i><b>Activités <small>(avec participation des prestataires de BusinessCare)</small></b>
                            4</p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Rendez-vous médicaux <small>(présentiel/visio)</small></b>
                            3</p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Rendez-vous médicaux supplémentaires <small>(aux frais du salariés)</small></b>
                            50€/rdv
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Accès au ChatBot</b>
                        illimité
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Accès aux fiches pratiques BusinessCare</b>
                        illimité
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Conseils hebdomadaires</b>
                            Oui et personnalisable (suggestion d'activités)
                        </p>
                        <p class="mb-2"><i class="mdi mdi-close-circle text-danger f-18 mr-2"></i><b>Évènements / Communautés <small>(sans intervention des prestataires de BusinessCare, évènements interne à l'entreprise)</small></b>
                        illimité
                        </p>
                    </div>

                    <div class="pricing-plan mt-4 pt-2">
                        <h4 class="text-muted"><s> 160€</s> <span class="plan pl-3 text-dark">100€ </span></h4>
                        <p class="text-muted mb-0">Annuel et par salarié</p>
                    </div>

                    <div class="mt-4 pt-3">
                        <a href="payment.php?id=3" class="btn btn-primary btn-rounded">Choisir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>
</main>
</body>
</html>