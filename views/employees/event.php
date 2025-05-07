<?/*

VERSION SUPRESSION ANCIENNES DATES - REFAIRE CETTE PARTIE
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: index.php');
    exit;
}
include('includes/db.php');
$credit_query = "SELECT credit FROM users WHERE id = {$_SESSION['id']}";
$result = $bdd->query($credit_query);
$user_credit = $result->fetch(PDO::FETCH_ASSOC);

if ($user_credit['credit'] == 0) {
    header('location: choix_payement.php');
    exit;
}

try {
    // Commencer une transaction
    $bdd->beginTransaction();

    // Étape 1 : Supprimer les entrées associées dans la table reserve
    $query_delete_reserves = "DELETE FROM reserve WHERE id_evenement IN (SELECT id FROM evenement WHERE date < CURDATE())";
    $stmt_delete_reserves = $bdd->prepare($query_delete_reserves);
    $stmt_delete_reserves->execute();

    // Étape 2 : Supprimer les événements passés
    $query_delete_events = "DELETE FROM evenement WHERE date < CURDATE()";
    $stmt_delete_events = $bdd->prepare($query_delete_events);
    $stmt_delete_events->execute();

    // Valider la transaction
    $bdd->commit();

    echo "Les événements dépassés et leurs réservations associées ont été supprimés avec succès.";
} catch (PDOException $e) {
    // Annuler la transaction en cas d'erreur
    $bdd->rollBack();
}*/
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
<!DOCTYPE HTML>

<html>
<?php include('../includes/head.php'); ?>

<?php include('includes/header.php'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="/Projet-Annuel-2i1/PA2i1/views/employees/js/event.js" defer></script>
    <main>
    <div class="container">
        <div class="schedules-area pd-top-110 pd-bottom-120">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <br>
                    <div class="section-title text-center">
                        <h1>Évènements programmés pour ce cours :</h1>
                        <br>
                        <p>Vous pouvez choisir une date afin de vous y inscrire.</p>
                        <p>Si aucune date n'est disponible, vous pouvez recevoir une alerte par mail dès qu'une nouvelle sera disponible.</p>

                    </div>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-primary profile-button" data-bs-toggle="modal" data-bs-target="#request">
                <i class="bi bi-clipboard2-plus"></i> Demande d'évènement
            </button>

            <button type="button" class="btn btn-warning profile-button" data-bs-toggle="modal" data-bs-target="#rating">
                <i class="bi bi-star"></i> Noter les évènements
            </button>

            <div class="modal fade" id="request" tabindex="-1" aria-labelledby="request" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/Projet-Annuel-2i1/PA2i1/api/apiNote.php?action=create" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Demande d'évènement à votre employeur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                        <h6 class="modal-text mb-3">Formulaire :</h6>

                        <div class="mb-3">
                            <label for="note-title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="note-title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="note-description" class="form-label">Description</label>
                            <textarea class="form-control" id="note-description" name="description" rows="4" required></textarea>
                        </div>
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <br><br>
            <div class="evt-tab-inner text-center">
                <ul class="nav nav-tabs" id="eventDateTabs" role="tablist">
                </ul>
            </div>

            <div id="eventDetailsContainer">
            </div>

            <!-- <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-title text-center">
                        <h1>Lieu du cours :</h1>
                        <br>
                        <p>242 Rue du Faubourg Saint-Antoine, 75012 Paris, France</p>
                    </div>
                </div>
            </div>
            <div class="ratio ratio-21x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.2775760830753!2d2.3824539!3d48.8490961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6720d9c7af387%3A0x5891d8d62e8535c7!2sYour%20Location%20Name!5e0!3m2!1sen!2sus!4v1672242259543!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> -->
        </div>
    </div>
</main>
</body>
</html>