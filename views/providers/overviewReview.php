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

<?php include('../includes/head.php'); ?>

    <body>
    <?php include('includes/header.php'); ?>

<main style="padding-left: 20px;  padding-right: 20px;">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="event-schedule-area-two bg-color pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text">
                        <h2>Évènements réalisés</h2>
                    </div>
                    <p>
                        Voici la liste des évènements réalisés ainsi que les notes laissées par les participants<br />
                        
                    </p>
                </div>
            </div>
            <!-- /.col end-->
        </div>
        <!-- row end-->
        <div class="row">
            <div class="col-lg-12">
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Date</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Lieu</th>
                                        <th class="text-center" scope="col">Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="inner-box">
                                        <th scope="row">
                                            <div class="event-date">
                                                <span>16</span>
                                                <p>Novembar</p>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="event-wrap">
                                                <h3><a>Evenement 1</a></h3>
                                                <div class="meta">
                                                    <div class="stars">
                                                        <a><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></a>
                                                    </div>
                                                    <div class="time">
                                                        <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="r-no">
                                                <a class="btn btn-primary" href=""><i class="bi bi-pin"></i> Lieu</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="primary-btn">
                                                <a class="btn btn-success" href="review.php"><i class="bi bi-info-circle"></i> Read More</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="inner-box">
                                        <th scope="row">
                                            <div class="event-date">
                                                <span>20</span>
                                                <p>Novembar</p>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="event-wrap">
                                                <h3><a>Evenement 2</a></h3>
                                                <div class="meta">
                                                    <div class="organizers">
                                                        <a><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"><i class="bi bi-star"></i></i></a>
                                                    </div>
                                                    <div class="time">
                                                        <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="r-no">
                                                <a class="btn btn-primary" href=""><i class="bi bi-pin"></i> Lieu</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="primary-btn">
                                                <a class="btn btn-success" href="review.php"><i class="bi bi-info-circle"></i> Read More</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="inner-box border-bottom-0">
                                        <th scope="row">
                                            <div class="event-date">
                                                <span>18</span>
                                                <p>Novembar</p>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="event-wrap">
                                                <h3><a>BEvenement 3</a></h3>
                                                <div class="meta">
                                                    <div class="organizers">
                                                        <a><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i></a>
                                                    </div>
                                                    <div class="time">
                                                        <span>05:35 AM - 08:00 AM 2h 25'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="r-no">
                                                <a class="btn btn-primary" href=""><i class="bi bi-pin"></i> Lieu</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="primary-btn">
                                                <a class="btn btn-success" href="review.php"><i class="bi bi-info-circle"></i> Read More</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="primary-btn text-center">
                    <a href="#" class="btn btn-primary">Download Schedule</a>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
</div>
</main>
</body>
</html>