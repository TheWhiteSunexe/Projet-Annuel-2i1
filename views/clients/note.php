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
if (!AuthMiddleware::checkAccess('clients')) {
    header('Location: /Projet-Annuel-2i1/PA2i1/views/login.php');
    exit();
}

// $router->dispatch();
?>
<!DOCTYPE HTML>
<html>
    <?php include('../includes/head.php'); ?>    
    <body style="color: inherit;!important">
        
        <?php include('includes/header.php'); ?>
        
        <main style=" background-color: #EBF2FA;!important height: 800px;"><br><br>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="page-content container note-has-grid">
                <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
                    <h2 class="fw-thin">Demande des employés</h2>
                    <!-- <li class="nav-item ml-auto">
                        <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-notes"> <i class="icon-note m-1"></i><span class="d-none d-md-block font-14">Add Notes</span></a>
                    </li> -->
                </ul>

                <div class="tab-content bg-transparent">
                    <div id="note-full-container" class="note-has-grid row">

                    
                    </div>
                </div>

                <!-- Modal Add notes -->
                <div class="modal fade" id="addnotesmodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title text-white">Ajouter une note</h5>
                                <button style="background-color: #98B9B2;border: none;box-shadow: none;color: rgb(0, 0, 0);" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="addnote.php" method="post">
                                <div class="modal-body">
                                    <div class="notes-box">
                                        <div class="notes-content">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="note-title" >
                                                        <label for="note-has-title">Titre de la note</label>
                                                        <input style="margin: 0px!important;box-shadow: none!important;" type="text" id="note-has-title" name="titre" class="form-control" minlength="10" placeholder="Titre" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="note-description">
                                                        <label for="note-has-description">Description</label>
                                                        <textarea id="note-has-description" name="description" class="form-control" minlength="10" placeholder="Description" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <script src="/Projet-Annuel-2i1/PA2i1/views/clients/script/note.js"></script>
        </main>
    </body>
</html>      
  