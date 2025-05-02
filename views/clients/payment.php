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
    <link rel="stylesheet" href="../../assets/styles/payment.css">

    <script src="https://js.stripe.com/v3/"></script>
</head>
  <body>

  <?php include('includes/header.php'); ?>
<main>
<div class="container bg-light d-md-flex align-items-center">
  <div class="card box1 shadow-sm p-md-5 p-4">
    <div class="fw-bolder mb-4">
      <span class="fas fa-dollar-sign"></span>
      <span class="ps-1">599,00</span>
    </div>
    <div class="d-flex flex-column">
      <div class="d-flex align-items-center justify-content-between text">
        <span>Commission</span>
        <span class="fas fa-dollar-sign">
          <span class="ps-1">1.99</span>
        </span>
      </div>
      <div class="d-flex align-items-center justify-content-between text mb-4">
        <span>Total</span>
        <span class="fas fa-dollar-sign">
          <span class="ps-1">600.99</span>
        </span>
      </div>
      <div class="border-bottom mb-4"></div>
      <div class="d-flex flex-column mb-4">
        <span class="far fa-file-alt text">
          <span class="ps-2">Invoice ID:</span>
        </span>
        <span class="ps-3">SN8478042099</span>
      </div>
      <div class="d-flex flex-column mb-5">
        <span class="far fa-calendar-alt text">
          <span class="ps-2">Next payment:</span>
        </span>
        <span class="ps-3">22 july, 2018</span>
      </div>
      <div class="d-flex align-items-center justify-content-between text mt-5">
        <div class="d-flex flex-column text">
          <span>Customer Support:</span>
          <span>online chat 24/7</span>
        </div>
        <div class="btn btn-primary rounded-circle">
          <span class="fas fa-comment-alt"></span>
        </div>
      </div>
    </div>
  </div>

  <div class="card box2 shadow-sm">
    
    <div class="d-flex align-items-center justify-content-between p-md-5 p-4">
      <span class="h5 fw-bold m-0">Payment methods</span>
    </div>

    <ul class="nav nav-tabs mb-3 px-md-4 px-2">
      <li class="nav-item">
        <a class="nav-link px-2 active" aria-current="page" href="#">Credit Card</a>
      </li>
    </ul>

    <form id="payment-form" action="/Projet-Annuel-2i1/PA2i1/api/ApiPayment.php" method="POST">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column px-md-5 px-4 mb-4">
                    <span>Credit Card</span>
                    <div id="card-element" class="inputWithIcon">
                        <!-- Un champ de carte de crédit sera inséré ici par Stripe Elements -->
                    </div>
                    <div id="card-errors" role="alert"></div>
                </div>
            </div>


            <div class="col-12 px-md-5 px-4 mt-3">
            <button type="submit" class="btn btn-primary w-100" id="total-price">Pay $599.00</button>

            </div>
        </div>
    </form>
  </div>
</div>

</main>
<script src="script/payment.js"></script>

</body>
</html>
<!-- 
            <div class="col-md-6">
                <div class="d-flex flex-column ps-md-5 px-md-0 px-4 mb-4" style="padding-left: 3rem !important;">
                    <span>Expiration<span class="ps-1">Date</span></span>
                    <div class="inputWithIcon">
                        <input type="text" class="form-control" id="expiration" required>
                        <span class="fas fa-calendar-alt"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex flex-column pe-md-5 px-md-0 px-4 mb-4">
                    <span>Code CVV</span>
                    <div class="inputWithIcon">
                        <input type="password" class="form-control" id="cvv" required>
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex flex-column px-md-5 px-4 mb-4">
                    <span>Name</span>
                    <div class="inputWithIcon">
                        <input class="form-control text-uppercase" type="text" id="name" required>
                        <span class="far fa-user"></span>
                    </div>
                </div>
            </div> -->