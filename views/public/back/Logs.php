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
</head>

<body>
  <?php include('header.php'); ?>

  <?php include('sidebar.php'); ?>

  <main id="main" class="main">

  <?php   
        include('../includes/db.php');
        
            $q = '';

            if(isset($_POST['trier'])) {
                if($_POST['trier'] != 1){

                    if($_POST['trier'] == 2){
                        $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log ORDER BY id DESC";
                    }
                    elseif($_POST['trier'] == 3){
                        $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log ORDER BY date ASC";
                    }
                    elseif($_POST['trier'] == 4){
                        $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log ORDER BY date DESC";
                    }
                    elseif($_POST['trier'] == 5){
                        $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log ORDER BY utilisateur ASC";
                    }
                    elseif($_POST['trier'] == 6){
                        $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log ORDER BY utilisateur DESC";
                    }
                    elseif($_POST['trier'] == 7){
                        $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log WHERE niveau='réussi'";
                    }
                    elseif($_POST['trier'] == 8){
                        $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log WHERE niveau='échoué'";
                    }
                } else {
                    // Par défaut, trier par nom croissant
                    $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log ORDER BY id ASC";
                }
            } else {
                // Par défaut, trier par nom croissant
                $q = "SELECT id, date, UPPER(utilisateur) AS email, niveau, message FROM log ORDER BY id ASC";
            }

            // Exécution de la requête SQL
            $sql = $bdd->query($q);

            // Récupération des résultats de la requête
            $logco = $sql->fetchAll(PDO::FETCH_ASSOC);
            ?>
        
        <div class="container">
            <h1>Log de Connexion</h1>
            <div>
                <input type="text" id="search_input" oninput="search()" placeholder="search">
            </div>
            <script src="main.js"></script>
            <form action="log.php" method="post">
            <select name="trier">
                <option value="1" selected>id (croissant)</option>
                <option value="2">id (décroissant)</option>
                <option value="3">date (croissant)</option>
                <option value="4">date (décroissant)</option>
                <option value="5">utilisateur (croissant)</option>
                <option value="6">utilisateur (décroissant)</option>
                <option value="7">réussi</option>
                <option value="8">échoué</option>
            </select>
            <button type="submit">Changer</button>
            </form>
            <div id="result"></div>

            <table class="table table-striped mt-4">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Message</th>
                    <th>Utilisateur</th>
                </tr>
                
                <?php
                foreach ($logco as $log) {
                    echo '<tr>';
                    echo '<td>' . $log['id'] . '</td>';
                    echo '<td>' . $log['date'] . '</td>';
                    echo '<td>' . $log['niveau'] . '</td>';
                    echo '<td>' . $log['message'] . '</td>';
                    echo '<td>' . $log['email'] . '</td>';
                    echo '</tr>';
                }
                ?>

            </table>
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