<?php session_start(); 
include('includes/db.php');

$q = 'SELECT numero, exp_date, cvv FROM card WHERE id_user = :id';
$req = $bdd->prepare($q);
$req->execute([':id' => $_SESSION['id']]);
$existe = $req->fetchAll(PDO::FETCH_ASSOC);
if (empty($existe)) {
    header('location: card_check.php?renvoi=1');
    exit;
}

include('includes/db.php');

if (isset($_GET['alert']) && !empty($_GET['alert'])) {
    // Récupérer l'id de la réservation à supprimer
    $reservation_id = intval($_GET['id']);

    try {
        // Préparer la requête SQL pour vérifier la date de l'événement
        $query_check_date = "SELECT date FROM evenement WHERE id = :reservation_id";
        
        $stmt_check_date = $bdd->prepare($query_check_date);
        $stmt_check_date->execute([
            'reservation_id' => $reservation_id,
        ]);

        $event = $stmt_check_date->fetch(PDO::FETCH_ASSOC);

        if ($event) {
            $event_date = new DateTime($event['date']);
            $current_date = new DateTime();
            $interval = $current_date->diff($event_date);

            if ($interval->days > 14) {
                // La date de l'événement est dans plus de deux semaines donc suppression de la réservation
                $query_delete_reservation = "DELETE FROM reserve WHERE id_evenement = :reservation_id AND id_user = :user_id ";
                $stmt_delete_reservation = $bdd->prepare($query_delete_reservation);
                $stmt_delete_reservation->execute([
                    'reservation_id' => $reservation_id,
                    'user_id' => $_SESSION['id']
                ]);

                $query_add_credit = "UPDATE users SET credit = credit + 1 WHERE id = :user_id";
                $stmt_add_credit = $bdd->prepare($query_add_credit);
                $stmt_add_credit->execute([
                    'user_id' => $_SESSION['id']
                ]);

                if ($stmt_delete_reservation->rowCount() > 0 && $stmt_add_credit->rowCount() > 0) {
                    header('Location: reservation.php?message=Réservation supprimée avec succès&type=success');
                    exit;
                } else {
                    header('Location: reservation.php?message=Échec de la suppression de la réservation&type=danger');
                    exit;
                }
            } else {
                // La date de l'événement est dans moins de deux semaines
                header('Location: reservation.php?message=Impossible de supprimer la réservation, l\'événement est dans moins de deux semaines&type=danger');
                exit;
            }
        } else {
            header('Location: reservation.php?message=Réservation non trouvée&type=danger');
            exit;
        }
    } catch (PDOException $e) {
        header('Location: reservation.php?message=Une erreur est survenue: ' . $e->getMessage() . '&type=danger');
        exit;
    }
}

$credit_query = "SELECT credit FROM users WHERE id = :user_id";
$stmt = $bdd->prepare($credit_query);
$stmt->execute(['user_id' => $_SESSION['id']]);
$user_credit = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user_credit['credit'] > 0) {
    $update_query = "UPDATE users SET credit = credit - 1 WHERE id = :user_id";
    $stmt = $bdd->prepare($update_query);
    $stmt->execute(['user_id' => $_SESSION['id']]);

    $insert_query = "INSERT INTO reserve (id_user, id_evenement) VALUES (:id_user, :id_evenement)";
    $stmt = $bdd->prepare($insert_query);
    $stmt->execute(['id_user' => $_SESSION['id'], 'id_evenement' => $_GET['id']]);

    header('location: reservation.php?message=La réservation été effectuée !&type=success');
    exit;
}

?>


<!DOCTYPE HTML>
<html>

<head>
<title>Guepstar Formation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device, initial-scale">
    <meta name="description" content="Site permettant de se former sur l'informatique">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
        if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
            echo '<link rel="stylesheet" type="text/css" href="css/style_nightmode.css">';
            echo '<link rel="stylesheet" type="text/css" href="css/style_card.css">';
        } else {
            echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
            echo '<link rel="stylesheet" type="text/css" href="css/style_card.css">';
        }
        ?>
    </head>

    <?php
if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
        echo '<body style="background-color :#353535;">';
    } else {
        echo '<body>';
    }?>
        
        <?php include('includes/header.php'); ?>

        <main>
            <?php
            include('includes/db.php');
            $choix = $_GET['choix'];
            if($choix == 1){
                $credit = 1;
                $prix = 10.0;
                $total = 10 + 1.99;
            }elseif($choix == 2){
                $credit = 5;
                $prix = 45.0;
                $total = 45 + 1.99; 
            }elseif($choix == 3){
                $credit = 10;
                $prix = 90.0;
                $total = 90 + 1.99;
            }else{
                header('location: choix_payement.php?message=Une erreur s\'est produite, veuillez rééssayer.&type=warning');
            }



            $q = 'SELECT numero, exp_date, cvv FROM card WHERE id_user = :id';
            $req = $bdd->prepare($q);
            $req->execute([':id' => $_SESSION['id']]);
            $payementprofil = $req->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($payementprofil)) {
                echo '<br><br>
                <div role="alert">';
                    include('includes/message.php');
                    
                echo'
                </div>
                <div class="container bg-light d-md-flex align-items-center"> 
                    <div class="card box1 shadow-sm p-md-5 p-md-5 p-4"> 
                        <div class="fw-bolder mb-4">
                            <span id="span-droite" class="fas fa-dollar-sign"></span>
                            <span id="span-droite" class="ps-1">'.$prix.'.00€</span>
                        </div> 
                        <div class="d-flex flex-column"> 
                            <div class="d-flex align-items-center justify-content-between text"> 
                                <span id="span-droite" class="">Commission</span> 
                                <span id="span-droite" class="fas fa-dollar-sign">
                                    <span id="span-droite" class="ps-1">1.99</span></span> 
                                </div> 
                                <div class="d-flex align-items-center justify-content-between text mb-4"> 
                                    <span id="span-droite">Total</span> 
                                    <span id="span-droite" class="fas fa-dollar-sign">
                                        <span id="span-droite" class="ps-1">'.$total.'</span></span> 
                                    </div> 
                                    <div class="border-bottom mb-4"></div> 
                                    <div class="d-flex flex-column mb-4"> 
                                        <span id="span-droite" class="far fa-file-alt text">
                                            <span id="span-droite" class="ps-2">Commande ID:</span></span> 
                                            <span id="span-droite" class="ps-3">SN8478042099</span> 
                                        </div> 
                                        <div class="d-flex flex-column mb-5"> 
                                            <span id="span-droite" class="far fa-calendar-alt text">
                                                <span id="span-droite" class="ps-2">Nombre de crédit :</span></span> 
                                                <span id="span-droite" class="ps-3">'.$credit.'</span> 
                                            </div> 
                                            <div class="d-flex align-items-center justify-content-between text mt-5"> 
                                                <div class="d-flex flex-column text"> 
                                                    <span id="span-droite">Support client:</span> 
                                                    <span id="span-droite">chat en ligne 24/7</span> 
                                                </div> 
                                                <div class="btn btn-primary rounded-circle">
                                                
                                                    <span id="span-droite" class="fas fa-comment-alt">+</span>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 

                                    <div class="card box2 shadow-sm"> 
                                        <div class="d-flex align-items-center justify-content-between p-md-5 p-4"> 
                                            <span class="h5 fw-bold m-0">Méthode de payement</span> 
                                            <div class="btn btn-primary bar">
                                                <span class="fas fa-bars"></span>
                                            </div> 
                                        </div> 
                                        <ul class="nav nav-tabs mb-3 px-md-4 px-2"> 
                                            <li class="nav-item"> 
                                                <a class="nav-link px-2 active" aria-current="page" href="#">Carte de crédit</a> 
                                            </li> 
                                            <li class="nav-item"> 
                                                <a class="nav-link px-2" href="payement.php?message=Arrive prochainement !&type=warning&choix='.$choix.'">Mobile Payment</a> 
                                            </li> 
                                            <li class="nav-item ms-auto"> 
                                                <a class="nav-link px-2" href="#">+ More</a> 
                                            </li> 
                                        </ul> 
                                        <div class="px-md-5 px-4 mb-4 d-flex align-items-center"> 
                                            <div class="btn btn-success me-4">
                                                <span class="fas fa-plus"><a href="card_check.php">+</a></span>
                                            </div> 
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">';
                                            include('includes/db.php');

                                            $q = 'SELECT numero, exp_date, cvv, id, numero_5 FROM card WHERE id_user = :id';
                                            $req = $bdd->prepare($q);
                                            $req->execute([':id' => $_SESSION['id']]);
                                            $result = $req->fetchAll(PDO::FETCH_ASSOC);
                    
                                            // Vérification si des résultats ont été retournés
                                            if (!empty($result)) {
                                                $compteur = 0;
                                                $compteur2 = 0;
                                                foreach ($result as $row) {
                                                    if($compteur<2){
                                                        $compteur++;
                                                        if($compteur2<1){
                                                            $compteur2++;
                                                            echo '
                                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked> 
                                                            <label class="btn btn-outline-primary" for="btnradio1">
                                                            <span class="pe-1">+</span>' . substr($row["numero_5"], -4) . '</label>'; 
                                                        }else{
                                                        echo'
                                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"> 
                                                        <label class="btn btn-outline-primary" for="btnradio2">
                                                        <span class="lpe-1">+</span>' . substr($row["numero_5"], -4) . '</label>';}
                                                    }else{}
                                                }
                                            }
                                            echo'
                                            </div> 
                                            </div> 
                                            <form action="transaction.php?id='.$row["id"].'&montant='.$total.'&type='.$choix.'" method="post"> 
                                                <div class="row"> 
                                                    <div class="col-12"> 
                                                        <div class="d-flex flex-column px-md-5 px-4 mb-4"> 
                                                            <span>Credit Card</span> 
                                                            <div class="inputWithIcon"> 
                                                            <input class="form-control" type="text" name="numero" value="' . htmlspecialchars($_COOKIE['numero']) . '">

                                                            </div> 
                                                        </div> 
                                                    </div> 
                                                    <div class="col-md-6"> 
                                                        <div class="d-flex flex-column ps-md-5 px-md-0 px-4 mb-4"> 
                                                            <span>Expiration<span class="ps-1">Date</span>
                                                            </span> 
                                                            <div class="inputWithIcon"> 
                                                                <input type="text" class="form-control" name="exp_date" value="' . $_COOKIE['exp_date'] . '"> 
                                                                <span class="fas fa-calendar-alt"></span> 
                                                            </div> 
                                                        </div> 
                                                    </div> 
                                                    <div class="col-md-6"> 
                                                        <div class="d-flex flex-column pe-md-5 px-md-0 px-4 mb-4"> 
                                                            <span>Code CVV</span> 
                                                            <div class="inputWithIcon"> 
                                                                <input type="password" class="form-control" name="cvv" value="' . $_COOKIE['cvv'] . '"> 
                                                                <span class="fas fa-lock">
                                                                </span> 
                                                            </div> 
                                                        </div> 
                                                    </div> 
                                                    <div class="col-12"> 
                                                        <div class="d-flex flex-column px-md-5 px-4 mb-4"> 
                                                            <span>Nom</span> 
                                                            <div class="inputWithIcon"> 
                                                                <input class="form-control text-uppercase" name="nom" type="text" value="Véronique Sanson"> 
                                                                <span class="far fa-user">
                                                                </span> 
                                                            </div> 
                                                        </div> 
                                                    </div> 
                                                    <div class="col-12 px-md-5 px-4 mt-3"> 
                                                        <button type="submit" class="btn btn-primary w-100">Payez '.$total.' €
                                                        </button> 
                                                    </div> 
                                                </div> 
                                                
                                            </form> 
                                        </div> 
                                    </div>';
            }                
            ?>
        </main>
        <?php include('includes/footer.php'); ?>
    </body>
 </html>