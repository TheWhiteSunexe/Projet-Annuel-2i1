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
    <?php include('includes/head.php'); ?>    
    <body>
        
        <?php include('includes/header.php'); ?>
        
        <main>
        <div class="content">
            <style>.button{weight:50px;}</style>
            <div id='calendar'></div>
        </div>
    
    

    <script src="/Projet-Annuel-2i1/PA2i1/assets/calendar/js/jquery-3.3.1.min.js"></script>
    <script src="/Projet-Annuel-2i1/PA2i1/assets/calendar/js/popper.min.js"></script>
    <script src="/Projet-Annuel-2i1/PA2i1/assets/calendar/js/bootstrap.min.js"></script>

    <script src='/Projet-Annuel-2i1/PA2i1/assets/calendar/fullcalendar/packages/core/main.js'></script>
    <script src='/Projet-Annuel-2i1/PA2i1/assets/calendar/fullcalendar/packages/interaction/main.js'></script>
    <script src='/Projet-Annuel-2i1/PA2i1/assets/calendar/fullcalendar/packages/daygrid/main.js'></script>
    
    <div id="calendar"></div>

    <script>
        var eventsData = <?php echo $events_json; ?>;
    </script>
    <script src="/Projet-Annuel-2i1/PA2i1/views/public/js/calendar.js" defer></script>
    <script src="/Projet-Annuel-2i1/PA2i1/assets/calendar/js/main.js"></script>
        </main>
    </body>
</html>      
  