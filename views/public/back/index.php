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
</head>

<body>
  <?php include('header.php'); ?>

  <?php include('sidebar.php'); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tableau de bord</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                    <li><a class="dropdown-item" href="#">Ce mois</a></li>
                    <li><a class="dropdown-item" href="#">Cette année</a></li>
                  </ul>
                </div>

                <div class="card-body">
              <?php
              include('../includes/db.php');

              // Obtenir l'année actuelle et l'année dernière
              $currentYear = date('Y');
              $lastYear = $currentYear - 1;

              // Requête SQL pour compter le nombre de transactions pour cette année
              $queryCurrentYear = 'SELECT COUNT(*) AS total_transactions FROM transaction WHERE YEAR(date) = :currentYear';
              $stmtCurrentYear = $bdd->prepare($queryCurrentYear);
              $stmtCurrentYear->bindParam(':currentYear', $currentYear, PDO::PARAM_INT);
              $stmtCurrentYear->execute();
              $rowCurrentYear = $stmtCurrentYear->fetch(PDO::FETCH_ASSOC);

              // Requête SQL pour compter le nombre de transactions pour l'année dernière
              $queryLastYear = 'SELECT COUNT(*) AS total_transactions FROM transaction WHERE YEAR(date) = :lastYear';
              $stmtLastYear = $bdd->prepare($queryLastYear);
              $stmtLastYear->bindParam(':lastYear', $lastYear, PDO::PARAM_INT);
              $stmtLastYear->execute();
              $rowLastYear = $stmtLastYear->fetch(PDO::FETCH_ASSOC);

              // Calculer le pourcentage d'augmentation
              $totalCurrentYear = $rowCurrentYear['total_transactions'];
              $totalLastYear = $rowLastYear['total_transactions'];

              if ($totalLastYear > 0) {
                  $percentageIncrease = (($totalCurrentYear - $totalLastYear) / $totalLastYear) * 100;
              } else {
                  $percentageIncrease = 100; // Considérons 100% d'augmentation si l'année dernière n'a pas de transactions
              }
              ?>

              <h5 class="card-title">Ventes <span>| Cette année</span></h5>

              <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                      <h6><?php echo $totalCurrentYear; ?></h6>
                      <?php if ($percentageIncrease >= 0): ?>
                          <span class="text-success small pt-1 fw-bold"><?php echo number_format($percentageIncrease, 0); ?>%</span>
                          <span class="text-muted small pt-2 ps-1">en hausse</span>
                      <?php else: ?>
                          <span class="text-danger small pt-1 fw-bold"><?php echo number_format(abs($percentageIncrease), 0); ?>%</span>
                          <span class="text-muted small pt-2 ps-1">en baisse</span>
                      <?php endif; ?>
                  </div>
              </div>
          </div>


              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                    <li><a class="dropdown-item" href="#">Ce mois</a></li>
                    <li><a class="dropdown-item" href="#">Cette année</a></li>
                  </ul>
                </div>

                <div class="card-body">
                <?php
                include('../includes/db.php');

                // Obtenir l'année actuelle et l'année dernière
                $currentYear = date('Y');
                $lastYear = $currentYear - 1;

                // Requête SQL pour additionner toutes les valeurs dans la colonne montant pour cette année
                $queryCurrentYear = 'SELECT SUM(montant) AS total_montant FROM transaction WHERE YEAR(date) = :currentYear';
                $stmtCurrentYear = $bdd->prepare($queryCurrentYear);
                $stmtCurrentYear->bindParam(':currentYear', $currentYear, PDO::PARAM_INT);
                $stmtCurrentYear->execute();
                $rowCurrentYear = $stmtCurrentYear->fetch(PDO::FETCH_ASSOC);

                // Requête SQL pour additionner toutes les valeurs dans la colonne montant pour l'année dernière
                $queryLastYear = 'SELECT SUM(montant) AS total_montant FROM transaction WHERE YEAR(date) = :lastYear';
                $stmtLastYear = $bdd->prepare($queryLastYear);
                $stmtLastYear->bindParam(':lastYear', $lastYear, PDO::PARAM_INT);
                $stmtLastYear->execute();
                $rowLastYear = $stmtLastYear->fetch(PDO::FETCH_ASSOC);

                // Calculer le pourcentage d'augmentation
                $totalCurrentYear = $rowCurrentYear['total_montant'];
                $totalLastYear = $rowLastYear['total_montant'];

                if ($totalLastYear > 0) {
                    $percentageIncrease = (($totalCurrentYear - $totalLastYear) / $totalLastYear) * 100;
                } else {
                    $percentageIncrease = 100; // Considérons 100% d'augmentation si l'année dernière n'a pas de montant
                }
                ?>

                <h5 class="card-title">Revenu <span>| Cette année</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <h6>$<?php echo number_format($totalCurrentYear, 0); ?></h6>
                        <?php if ($percentageIncrease >= 0): ?>
                            <span class="text-success small pt-1 fw-bold"><?php echo number_format($percentageIncrease, 0); ?>%</span>
                            <span class="text-muted small pt-2 ps-1">en hausse</span>
                        <?php else: ?>
                            <span class="text-danger small pt-1 fw-bold"><?php echo number_format(abs($percentageIncrease), 0); ?>%</span>
                            <span class="text-muted small pt-2 ps-1">en baisse</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                    <li><a class="dropdown-item" href="#">Ce mois</a></li>
                    <li><a class="dropdown-item" href="#">Cette année</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Clients <span>| Cette année</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <?php 
                      include('../includes/db.php');

                      // Requête pour compter le nombre de membres inscrits cette année
                      $query_cette_annee = 'SELECT COUNT(*) AS nb_membres_inscrits_cette_annee FROM users WHERE YEAR(date_insc) = YEAR(CURDATE())';
                      $result_cette_annee = $bdd->query($query_cette_annee);
                      $row_cette_annee = $result_cette_annee->fetch(PDO::FETCH_ASSOC);
                      $nb_membres_cette_annee = $row_cette_annee['nb_membres_inscrits_cette_annee'];

                      // Requête pour compter le nombre de membres inscrits l'année dernière
                      $query_annee_derniere = 'SELECT COUNT(*) AS nb_membres_inscrits_annee_derniere FROM users WHERE YEAR(date_insc) = YEAR(CURDATE()) - 1';
                      $result_annee_derniere = $bdd->query($query_annee_derniere);
                      $row_annee_derniere = $result_annee_derniere->fetch(PDO::FETCH_ASSOC);
                      $nb_membres_annee_derniere = $row_annee_derniere['nb_membres_inscrits_annee_derniere'];

                      // Calcul du pourcentage
                      if ($nb_membres_annee_derniere !== null && $nb_membres_annee_derniere != 0) {
                          $pourcentage = round(($nb_membres_cette_annee - $nb_membres_annee_derniere) / $nb_membres_annee_derniere * 100);
                      } else {
                          // Gérer le cas où le nombre de membres inscrits l'année dernière est égal à zéro pour éviter une division par zéro
                          $pourcentage = 0;
                      }
                      ?>

                    <div class="ps-3">
                      <h6><? echo $nb_membres_cette_annee?></h6>
                      <?php
                        if($pourcentage >0){
                        echo '<span class="text-success small pt-1 fw-bold">'. $pourcentage.'%</span> <span class="text-muted small pt-2 ps-1">en hausse</span>';
                        }else{
                          '<span class="text-danger small pt-1 fw-bold">'. $pourcentage.'%</span> <span class="text-muted small pt-2 ps-1">en baisse</span>';
                        }
                      ?>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                    <li><a class="dropdown-item" href="#">Ce mois</a></li>
                    <li><a class="dropdown-item" href="#">Cette année</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>| Aujourd'hui</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>
                  <?php
                  include('../includes/db.php');

                  // Obtenir les 7 derniers mois
                  $months = [];
                  for ($i = 6; $i >= 0; $i--) {
                      $months[] = date("Y-m", strtotime("-$i month"));
                  }

                  // Initialiser les données
                  $salesData = [];
                  $revenueData = [];
                  $customersData = [];

                  // Initialiser les valeurs à zéro pour chaque mois
                  foreach ($months as $month) {
                      $salesData[$month] = 0;
                      $revenueData[$month] = 0;
                      $customersData[$month] = [];
                  }

                  // Requête pour obtenir les ventes et les revenus des 7 derniers mois
                  $querySales = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) AS sales_count, SUM(montant) AS total_revenue 
                                FROM transaction 
                                WHERE date >= DATE_SUB(CURDATE(), INTERVAL 7 MONTH) 
                                GROUP BY month";
                  $stmtSales = $bdd->query($querySales);
                  $salesResults = $stmtSales->fetchAll(PDO::FETCH_ASSOC);

                  // Remplir les données de ventes et de revenus
                  foreach ($salesResults as $result) {
                      $salesData[$result['month']] = (int) $result['sales_count'];
                      $revenueData[$result['month']] = (float) $result['total_revenue'];
                  }

                  // Requête pour obtenir le nombre d'utilisateurs des 7 derniers mois
                  $queryCustomers = "SELECT DATE_FORMAT(date_insc, '%Y-%m') AS month, COUNT(*) AS customer_count 
                                    FROM users 
                                    WHERE date_insc >= DATE_SUB(CURDATE(), INTERVAL 7 MONTH) 
                                    GROUP BY month";
                  $stmtCustomers = $bdd->query($queryCustomers);
                  $customerResults = $stmtCustomers->fetchAll(PDO::FETCH_ASSOC);

                  // Remplir les données des utilisateurs
                  foreach ($customerResults as $result) {
                      $customersData[$result['month']] = (int) $result['customer_count'];
                  }

                  // Transformer les données pour le format JavaScript
                  $salesDataJS = [];
                  $revenueDataJS = [];
                  $customersDataJS = [];

                  foreach ($months as $month) {
                      $salesDataJS[] = $salesData[$month];
                      $revenueDataJS[] = $revenueData[$month];
                      $customersDataJS[] = $customersData[$month];
                  }
                  ?>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                      series: [{
                          name: 'Sales',
                          data: <?php echo json_encode(array_values($salesDataJS)); ?>
                      }, {
                          name: 'Revenue',
                          data: <?php echo json_encode(array_values($revenueDataJS)); ?>
                      }, {
                          name: 'Customers',
                          data: <?php echo json_encode(array_values($customersDataJS)); ?>
                      }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        <?php
                        include('../includes/db.php');

                        // Obtenir les 7 derniers mois
                        $months = [];
                        for ($i = 6; $i >= 0; $i--) {
                            $months[] = date("Y-m", strtotime("first day of -$i month"));
                        }
                        ?>
                        xaxis: {
                          type: 'date',
                          categories: <?php echo json_encode($months); ?>,
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                    <li><a class="dropdown-item" href="#">Ce mois</a></li>
                    <li><a class="dropdown-item" href="#">Cette année</a></li>
                  </ul>
                </div>

                <div class="card-body">
    <h5 class="card-title">Ventes <span>| Aujourd'hui</span></h5>

    <table class="table table-borderless datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../includes/db.php');

            // Requête SQL pour obtenir les ventes récentes
            $queryRecentSales = 'SELECT id, id_user, montant FROM transaction ORDER BY date DESC LIMIT 10';
            $stmtRecentSales = $bdd->query($queryRecentSales);

            // Fonction pour générer un statut aléatoire
            function getRandomStatus() {
                $statuses = ['danger' => 'Rejected', 'success' => 'Approved', 'warning' => 'Pending'];
                $randomKey = array_rand($statuses);
                return ['class' => $randomKey, 'text' => $statuses[$randomKey]];
            }

            while ($row = $stmtRecentSales->fetch(PDO::FETCH_ASSOC)) {
                // Requête SQL pour obtenir les noms et prénoms des utilisateurs
                $queryName = 'SELECT nom, prenom FROM users WHERE id = :id';
                $stmtName = $bdd->prepare($queryName);
                $stmtName->bindParam(':id', $row['id_user'], PDO::PARAM_INT);
                $stmtName->execute();
                $user = $stmtName->fetch(PDO::FETCH_ASSOC);

                $status = getRandomStatus();
                echo '<tr>';
                echo '<th scope="row"><a href="#">#' . htmlspecialchars($row['id']) . '</a></th>';
                echo '<td>' . htmlspecialchars($user['nom']) . ' ' . htmlspecialchars($user['prenom']) . '</td>';
                echo '<td><a href="#" class="text-primary">Achat de crédits</a></td>'; // Remplacez "Product Name" par le nom réel du produit si disponible
                echo '<td>$' . number_format($row['montant'], 2) . '</td>';
                echo '<td><span class="badge bg-' . $status['class'] . '">' . $status['text'] . '</span></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>


              </div>
            </div><!-- End Recent Sales -->

            

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                <li><a class="dropdown-item" href="#">Ce mois</a></li>
                <li><a class="dropdown-item" href="#">Cette année</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Activité récente <span>| Aujourd'hui</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Modification de l'<a href="#" class="fw-bold text-dark">administration</a> du site
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Modification du fonctionnement des évènements.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Modification de la page forum.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">1 jour</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Modification des<a href="#" class="fw-bold text-dark"> review</a>.
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 jours</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Modification de l'ajout de cours
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">4 sema.</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Modification de la page profil
                  </div>
                </div><!-- End activity item-->

              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- Budget Report -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                <li><a class="dropdown-item" href="#">Ce mois</a></li>
                <li><a class="dropdown-item" href="#">Cette année</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Budget <span>| Ce mois</span></h5>

              <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                      data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                      // shape: 'circle',
                      indicator: [{
                          name: 'Sales',
                          max: 6500
                        },
                        {
                          name: 'Administration',
                          max: 16000
                        },
                        {
                          name: 'Information Technology',
                          max: 30000
                        },
                        {
                          name: 'Customer Support',
                          max: 38000
                        },
                        {
                          name: 'Development',
                          max: 52000
                        },
                        {
                          name: 'Marketing',
                          max: 25000
                        }
                      ]
                    },
                    series: [{
                      name: 'Budget vs spending',
                      type: 'radar',
                      data: [{
                          value: [4200, 3000, 20000, 35000, 50000, 18000],
                          name: 'Allocated Budget'
                        },
                        {
                          value: [5000, 14000, 28000, 26000, 42000, 21000],
                          name: 'Actual Spending'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Budget Report -->

          <!-- Website Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                <li><a class="dropdown-item" href="#">Ce mois</a></li>
                <li><a class="dropdown-item" href="#">Cette année</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Visite du site <span>| Aujourd'hui</span></h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: 1048,
                          name: 'Search Engine'
                        },
                        {
                          value: 735,
                          name: 'Direct'
                        },
                        {
                          value: 580,
                          name: 'Email'
                        },
                        {
                          value: 484,
                          name: 'Union Ads'
                        },
                        {
                          value: 300,
                          name: 'Video Ads'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->

          

        </div><!-- End Right side columns -->

      </div>
    </section>

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