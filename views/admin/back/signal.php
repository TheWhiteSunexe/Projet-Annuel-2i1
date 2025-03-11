<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Administration Business Care</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../assets/images/logoSmall.png" rel="icon">
  <link href="../../../assets/images/logoSmall.png" rel="apple-touch-icon">

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
</head>

<body>
  <?php include('header.php'); ?>

  <?php include('sidebar.php'); ?>

  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Suivi des Signalements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Signalement</li>
        </ol>
      </nav>
    </div>
    <form action="download-backend.php" method="post">
        <button class="btn btn-primary profile-button" type="submit"><i class="bi-download"></i> Télécharger les Signalements</button>
    </form>
    <br>
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Différents types de signalement en cours :</h5>

              <div class="accordion accordion-flush" id="faq-group-1">

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-1" type="button" data-bs-toggle="collapse">
                      Signalements liés aux messages dans le Forum
                    </button>
                  </h2>
                  <div id="faqsOne-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                    <div class="accordion-body">
                    <table class="table table-striped mt-4" id="clients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Contenu</th>
                                <th>Capture d'écran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tab-1">
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-2" type="button" data-bs-toggle="collapse">
                     Signalements liés aux Sujets du Forum
                    </button>
                  </h2>
                  <div id="faqsOne-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                    <div class="accordion-body">
                    <table class="table table-striped mt-4" id="clients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Contenu</th>
                                <th>Capture d'écran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tab-2">
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-3" type="button" data-bs-toggle="collapse">
                    Signalements liés au Chatbot
                    </button>
                  </h2>
                  <div id="faqsOne-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                    <div class="accordion-body">
                    <table class="table table-striped mt-4" id="clients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Contenu</th>
                                <th>Capture d'écran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tab-3">
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-4" type="button" data-bs-toggle="collapse">
                    Signalements liés aux Comptes utilisateurs
                    </button>
                  </h2>
                  <div id="faqsOne-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                    <div class="accordion-body">
                    <table class="table table-striped mt-4" id="clients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Contenu</th>
                                <th>Capture d'écran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tab-4">
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-5" type="button" data-bs-toggle="collapse">
                    Signalements liés aux évènements
                    </button>
                  </h2>
                  <div id="faqsOne-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                    <div class="accordion-body">
                    <table class="table table-striped mt-4" id="clients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Contenu</th>
                                <th>Capture d'écran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tab-5">
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-target="#faqsOne-6" type="button" data-bs-toggle="collapse">
                    Signalements liés à la FAQ
                    </button>
                  </h2>
                  <div id="faqsOne-6" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                    <div class="accordion-body">
                    <table class="table table-striped mt-4" id="clients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Contenu</th>
                                <th>Capture d'écran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tab-6">
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
</main>
  <script src="/Projet-Annuel-2i1\PA2i1\views\admin\back\js\signal.js"></script>

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
  <script src="assets/js/main.js"></script>

</body>

</html>