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
                        $q = "SELECT id, date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY auteur DESC";
                    }
                    elseif($_POST['trier'] == 3){
                        $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY id ASC";
                    }
                    elseif($_POST['trier'] == 4){
                        $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY id DESC";
                    }
                    elseif($_POST['trier'] == 5){
                        $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY titre ASC";
                    }
                    elseif($_POST['trier'] == 6){
                        $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY titre DESC";
                    }
                    elseif($_POST['trier'] == 7){
                        $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY texte ASC";
                    }
                    elseif($_POST['trier'] == 8){
                        $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY texte DESC";
                    }
                } else {
                    // Par défaut, trier par nom croissant
                    $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY auteur ASC";
                }
            } else {
                // Par défaut, trier par nom croissant
                $q = "SELECT id,date, titre, UPPER(auteur) AS auteur, texte FROM newsletter ORDER BY auteur ASC";
            }

            // Exécution de la requête SQL
            $sql = $bdd->query($q);

            // Récupération des résultats de la requête
            $users = $sql->fetchAll(PDO::FETCH_ASSOC);
        ?>

        
        <div class="containeruti">
            <h1>Logs des Newsletters</h1>
        
            <div class="input-group mb-3">
                <input type="text" id="search_input" class="form-control" oninput="search()" placeholder="search">
                <button class="input-group-text" id="basic-addon2" type="submit">chercher</button>
            </div>
            <script src="main.js"></script>
            <form action="backend.php" method="post">
            <select name="trier">
                <option value="1" selected>auteur (croissant)</option>
                <option value="2">auteur (décroissant)</option>
                <option value="3">id (croissant)</option>
                <option value="4">id (décroissant)</option>
                <option value="5">a (croissant)</option>
                <option value="6">email (décroissant)</option>
                <option value="7">formateur uniquement</option>
                <option value="8">utilisateur uniquement</option>
            </select>
            <button type="submit">Changer</button>
            </form>

           
            <div id="result">
            <table class="table table-striped mt-4">
                    <tr>
                        <th>#</th>
                        <th>Auteur</th>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php
                    foreach ($users as $user) {
                        echo '<tr>';
                        echo '<td>' . $user['id'] . '</td>';
                        echo '<td>' . $user['auteur'] . '</td>';
                        echo '<td>' . $user['date'] . '</td>';
                        echo '<td>' . $user['titre'] . '</td>';
                        echo '<td>' . $user['texte'] . '</td>';
                        echo '<td>
                            <a class="btn btn-danger btn-sm" href="../delete.php?id=' . $user['id'] . '">Supprimer</a>
                            
                            </td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
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