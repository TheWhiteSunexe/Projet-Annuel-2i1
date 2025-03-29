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
      <h1>Gestion des salles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Room</li>
        </ol>
      </nav>
    </div>
    <br>
    <div id="result">
    
            <small><font color="red">*</font> Ces données sont obligatoires pour la création d'une salle.</small>

            <form action="/Projet-Annuel-2i1/PA2i1/views/admin/back/api/ApiRoom.php" method="POST">

                <div class="form-group">
                    <label for="company_name"> Nom de la salle (ou numéro) :</label>
                    <input type="text" name="name" id="name" class="form-control" value="Salle ">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Capacité de la salle :</label>
                    <input type="text" name="capacity" id="capacity" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Adresse :</label>
                    <input type="text" name="address" id="address" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Code postal :</label>
                    <input type="text" name="postal_code" id="postal_code" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Ville :</label>
                    <input type="text" name="city" id="city" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="company_name"><font color="red">*</font> Pays :</label>
                    <input type="text" name="country" id="country" required class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>

                <div id="error_message" style="color: red;"></div>
            </form>
    </div>
</main>
  <script src="/Projet-Annuel-2i1\PA2i1\views\admin\back\js\room.js"></script>

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