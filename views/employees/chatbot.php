<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/middlewares/AuthMiddleware.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/models/UserModel.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/Controllers/AuthController.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/routes/web.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/controllers/CalendarController.php';
$events_json = CalendarController::getEventsJSON();

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
<!DOCTYPE HTML>

<html>
<?php include('../includes/head.php'); ?>

<?php include('includes/header.php'); ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- <script src="/Projet-Annuel-2i1/PA2i1/views/public/js/event.js" defer></script> -->
    <link rel="stylesheet" href="../../assets/styles/style_chatbot.css">
<main>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0">ChatBot</h6>
                                    <small>En ligne</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history">
                        <ul class="m-b-0" id="chat-messages" style="height: 400px;"></ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <select id="question-select" class="form-control">
                            <option value="">Choisissez une question...</option>
                                <option value="Quelle est la politique de congés ?">Quelle est la politique de congés ?</option>
                                <option value="Comment demander un congé ?">Comment demander un congé ?</option>
                                <option value="Quels sont les horaires de travail ?">Quels sont les horaires de travail ?</option>
                                <option value="Comment signaler un problème technique ?">Comment signaler un problème technique ?</option>
                                <option value="Qui contacter pour un problème RH ?">Qui contacter pour un problème RH ?</option>
                                <option value="Comment réserver une salle de réunion ?">Comment réserver une salle de réunion ?</option>
                                <option value="Comment soumettre une note de frais ?">Comment soumettre une note de frais ?</option>
                                <option value="Où trouver les documents internes ?">Où trouver les documents internes ?</option>
                                <option value="Comment modifier mes informations personnelles ?">Comment modifier mes informations personnelles ?</option>
                                <option value="Quelle est la politique de télétravail ?">Quelle est la politique de télétravail ?</option>
                                <option value="Comment accéder à mon compte email pro ?">Comment accéder à mon compte email pro ?</option>
                                <option value="Quels outils sont disponibles pour collaborer ?">Quels outils sont disponibles pour collaborer ?</option>
                                <option value="Comment déclarer un arrêt maladie ?">Comment déclarer un arrêt maladie ?</option>
                                <option value="Quelle est la procédure pour une démission ?">Quelle est la procédure pour une démission ?</option>
                                <option value="Où trouver les coordonnées du service IT ?">Où trouver les coordonnées du service IT ?</option>
                                <option value="Comment accéder à la plateforme de formation ?">Comment accéder à la plateforme de formation ?</option>
                                <option value="Quels sont les avantages employés ?">Quels sont les avantages employés ?</option>
                                <option value="Quelle est la politique de remboursement des frais ?">Quelle est la politique de remboursement des frais ?</option>
                                <option value="Comment obtenir une attestation de travail ?">Comment obtenir une attestation de travail ?</option>
                                <option value="Comment signaler un conflit au travail ?">Comment signaler un conflit au travail ?</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="sendMessage()">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sendMessage() {
        const select = document.getElementById("question-select");
        const question = select.value;
        if (!question) return;

        const chatMessages = document.getElementById("chat-messages");
        chatMessages.innerHTML += `<li class='clearfix'><div class='message other-message'>${question}</div></li>`;

        const responses = {
            "Quelle est la politique de congés ?": "Les congés sont accordés selon la convention collective et les accords d'entreprise.",
            "Comment demander un congé ?": "Vous devez faire une demande via l'outil RH ou en informer votre responsable.",
            "Quels sont les horaires de travail ?": "Les horaires standards sont de 9h à 18h avec une pause déjeuner.",
            "Comment signaler un problème technique ?": "Vous pouvez contacter le support IT par email ou téléphone.",
            "Qui contacter pour un problème RH ?": "Veuillez contacter le service des ressources humaines via l'intranet.",
            "Comment réserver une salle de réunion ?": "Les salles peuvent être réservées via l'outil de planification interne.",
            "Comment soumettre une note de frais ?": "Les notes de frais doivent être soumises via l'application de gestion des dépenses.",
            "Où trouver les documents internes ?": "Les documents sont disponibles sur l'intranet de l'entreprise.",
            "Comment modifier mes informations personnelles ?": "Vous pouvez mettre à jour vos informations via l'outil RH.",
            "Quelle est la politique de télétravail ?": "Le télétravail est possible selon l'accord de votre manager.",
            "Comment accéder à mon compte email pro ?": "Votre email pro est accessible via Outlook ou l'application de messagerie de l'entreprise.",
            "Quels outils sont disponibles pour collaborer ?": "Nous utilisons Teams, Slack et Google Drive pour la collaboration.",
            "Comment déclarer un arrêt maladie ?": "Un arrêt maladie doit être signalé à votre responsable et au service RH.",
            "Quelle est la procédure pour une démission ?": "Une lettre de démission doit être remise à votre employeur avec un préavis.",
            "Où trouver les coordonnées du service IT ?": "Les coordonnées sont disponibles sur l'intranet.",
            "Comment accéder à la plateforme de formation ?": "La plateforme de formation est accessible via votre compte employé.",
            "Quels sont les avantages employés ?": "Les avantages incluent des tickets restaurant, une mutuelle et des réductions.",
            "Quelle est la politique de remboursement des frais ?": "Les frais professionnels sont remboursés sur justificatif.",
            "Comment obtenir une attestation de travail ?": "Une attestation peut être demandée au service RH.",
            "Comment signaler un conflit au travail ?": "Tout conflit doit être signalé à votre manager ou au service RH."
        };

        setTimeout(() => {
            chatMessages.innerHTML += `<li class='clearfix'><div class='message my-message'>${responses[question]}</div></li>`;
        }, 500);
    }
</script>

</main>
</body>
</html>