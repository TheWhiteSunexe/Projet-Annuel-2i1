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

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<? include('../includes/head.php'); ?>

<body>
<? include('includes/header.php'); ?>


  <main id="main" class="main">
  <section id="heroBanner-login" style="height: 650px !important;">
  <div class="container-xl">
    <div class="pagetitle">
      <br>
      <h1 class="display-4">Profil Utilisateur</h1>
      <br>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="/Projet-Annuel-2i1/PA2i1/uploads/<?php echo !empty($_SESSION['img']) ? $_SESSION['img'] : 'default.jpg'; ?>" 
            alt="Profile" 
            class="rounded-circle" 
            style="height: 70px !important; width: 70px !important;">
              <h2 id="full-name-title">Chargement...</h2>
              <h3 id="company-title">Chargement...</h3>
              <div class="social-links mt-2">
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Général</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier Profil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Paramètres</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">À propos</h5>
                <p class="small fst-italic" id="service_description">Description de l'utilisateur...</p>

                <h5 class="card-title">Détails du Profil</h5>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nom complet</div>
                    <div class="col-lg-9 col-md-8" id="full-name">Chargement...</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Téléphone</div>
                    <div class="col-lg-9 col-md-8" id="phone">Chargement...</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8" id="email">Chargement...</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Entreprise</div>
                    <div class="col-lg-9 col-md-8" id="company">Chargement...</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Type de services</div>
                    <div class="col-lg-9 col-md-8" id="service_type">Chargement...</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Siret</div>
                    <div class="col-lg-9 col-md-8" id="siret">Chargement...</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Vat</div>
                    <div class="col-lg-9 col-md-8" id="vat_number">Chargement...</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pays</div>
                    <div class="col-lg-9 col-md-8" id="country">Chargement...</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Adresse</div>
                    <div class="col-lg-9 col-md-8" id="address">Chargement...</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Code Postal</div>
                    <div class="col-lg-9 col-md-8" id="postal_code">Chargement...</div>
                </div>

            </div>


                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="updateForm">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                      <img src="/Projet-Annuel-2i1/PA2i1/uploads/<?php echo !empty($_SESSION['img']) ? $_SESSION['img'] : 'default.jpg'; ?>" 
                      alt="Profile" 
                      class="rounded-circle" 
                      style="height: 70px !important; width: 70px !important;">
                      <div class="pt-2">
                        <input type="file" id="profileImageInput" accept="image/*" style="display: none;" onchange="uploadProfileImage()">
                        <a onclick="document.getElementById('profileImageInput').click();" class="btn btn-primary btn-sm" title="Upload new profile image">
                            <i class="bi bi-upload"></i>
                        </a>

                          <a onclick="deleteimg()" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="name-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="firstname-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Type de services</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="service_type-update" style="height: 100px"></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Description des services</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="service_description-update" style="height: 100px"></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Entreprise</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Siret</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="siret-update" >
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Vat</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="vat_number-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Pays</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="country-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="address-update" >
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Code postal</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="postal_code-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="phone-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email-update" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="link-update" >
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    
                  </form><!-- End Profile Edit Form -->
                  <br>
                  <div class="text-center">
                    <button onclick="deleteAccount()" class="btn btn-danger">Supprimer le compte</butto>
                  </div>
                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    </div>
    </section>
  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/quill/quill.js"></script>
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/Projet-Annuel-2i1/PA2i1/views/admin/back/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="js/user.js"></script>

</body>

</html>