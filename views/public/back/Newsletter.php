<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Administration Guepstar</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/style_reservation.css">
</head>

<body style="background-color:#98B9B2;" >
  <?php include('header.php'); ?>

  <?php include('sidebar.php'); ?>

  <main id="main" class="main">

  <div class="payement">
        <div class="card mt-50 mb-50">
            <div class="card-title mx-auto">
                Nouvelle newsletter
            </div>
            <div role="alert">
                        <?php include('../includes/message.php'); ?>
            </div>
            <form action="../verif_newsletter.php" method="post">
                <div class="row-1">
                    <div class="row row-2">
                        <span id="card-inner">Auteur</span>
                    </div>
                    <div class="row row-2">
                        <input type="text" name="auteur" placeholder="Auteur">
                    </div>
                </div>
                <div class="row-1">
                    <div class="row row-2">
                        <span id="card-inner">Titre de la newsletter</span>
                    </div>
                    <div class="row row-2">
                        <input type="text" name="titre" placeholder="Titre">
                    </div>
                </div>
                <div class="row-1">
                    <div class="row row-2">
                        <span id="card-inner">Contenu de la newsletter</span>
                    </div>
                    <div class="row row-2">
                        <input type="text" name="contenu" placeholder="Contenu">
                    </div>
                </div>

                <button class="btn d-flex mx-auto" type="submit"><b>Envoyer la newsletter</b></button>
            </form>
        </div>
    </div>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>