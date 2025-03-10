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

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="/Projet-Annuel-2i1/PA2i1/views/public/js/event.js" defer></script>
    <link rel="stylesheet" href="../../assets/styles/style_chatbot.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<main>


<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
            <div class="chat">
    <div class="chat-header clearfix">
        <div class="row">
            <div class="col-lg-6">
                <div class="chat-about">
                    <h6 class="m-b-0" id="chat-title"></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-history" style="height: 400px; overflow-y: auto;">
        <ul class="m-b-0" id="chat-messages"></ul>
    </div>
    <div class="chat-message clearfix">
        <div class="input-group mb-0">
            <input type="text" class="form-control" id="message-content" name="contenu" placeholder="Type your message">
            <input type="hidden" id="user-id" value="<?php echo $_SESSION['id']; ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="sendMessage()">Envoyer</button>
            </div>
        </div>
    </div>
</div>


            <script src='/Projet-Annuel-2i1/PA2i1/views\employees\js\chat.js'></script>
            

            </div>
        </div>
    </div>
</div>
</main>
</body>
</html>