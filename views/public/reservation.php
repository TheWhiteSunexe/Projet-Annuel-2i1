<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: index.php');
    exit;
}
include('includes/db.php');
$credit_query = "SELECT credit FROM users WHERE id = {$_SESSION['id']}";
$result = $bdd->query($credit_query);
$user_credit = $result->fetch(PDO::FETCH_ASSOC);

if ($user_credit['credit'] == 0) {
    header('location: choix_payement.php');
    exit;
}

try {
    // Commencer une transaction
    $bdd->beginTransaction();

    // Étape 1 : Supprimer les entrées associées dans la table reserve
    $query_delete_reserves = "DELETE FROM reserve WHERE id_evenement IN (SELECT id FROM evenement WHERE date < CURDATE())";
    $stmt_delete_reserves = $bdd->prepare($query_delete_reserves);
    $stmt_delete_reserves->execute();

    // Étape 2 : Supprimer les événements passés
    $query_delete_events = "DELETE FROM evenement WHERE date < CURDATE()";
    $stmt_delete_events = $bdd->prepare($query_delete_events);
    $stmt_delete_events->execute();

    // Valider la transaction
    $bdd->commit();

    echo "Les événements dépassés et leurs réservations associées ont été supprimés avec succès.";
} catch (PDOException $e) {
    // Annuler la transaction en cas d'erreur
    $bdd->rollBack();
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
        echo '<link rel="stylesheet" type="text/css" href="css/style_resa.css">';
    } else {
        echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
        echo '<link rel="stylesheet" type="text/css" href="css/style_resa.css">';
    }
    ?>
</head> <?php
if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
        echo '<body style="background-color :#353535;">';
    } else {
        echo '<body>';
    }?>
    
        
      <?php include('includes/header.php'); ?>

        <main>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="schedules-area pd-top-110 pd-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-title text-center">
                        <h1>Évènements programmés pour ce cours :</h1>
                        <br><p>Vous pouvez choisir une date afin de vous y inscrire.</p><p> Si aucune date n'est disponible vous pouvez revecoir une alerte par mail dès qu'une nouvelle sera disponible.</p>
                        <div role="alert">
                            <?php include('includes/message.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="evt-tab-inner text-center">
                <ul class="nav nav-tabs" id="ex1" role="tablist">
                <?php
                // Inclure le fichier de configuration de la base de données
                include('includes/db.php');

                // Requête SQL pour récupérer les trois premières dates de la table evenement
                if(isset($_GET['id']) && !empty($_GET['id'])){
                $query = "SELECT date FROM evenement WHERE id_cours={$_GET['id']} ORDER BY date ASC LIMIT 3";
                }else{
                $query = "SELECT date FROM evenement ORDER BY date ASC LIMIT 3";
                }
                
                $stmt = $bdd->query($query);

                // Vérifier s'il y a des résultats
                if ($stmt->rowCount() > 0) {
                    // Récupérer les résultats dans un tableau
                    $dates = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    // Stocker chaque date dans une variable distincte
                    if (isset($dates[0])) {
                        setlocale(LC_TIME, 'fr_FR.UTF-8');
                        $date1 = strftime('%e %b %Y', strtotime($dates[0])) ;
                        $date1nf = date('d/m/Y', strtotime($dates[0]));
                    }
                    if (isset($dates[1])) {
                        setlocale(LC_TIME, 'fr_FR.UTF-8');
                        $date2 = strftime('%e %b %Y', strtotime($dates[1]));
                        $date2nf = date('d/m/Y', strtotime($dates[1]));
                    }
                    if (isset($dates[2])) {
                        setlocale(LC_TIME, 'fr_FR.UTF-8');
                        $date3 = strftime('%e %b %Y', strtotime($dates[2]));
                        $date3nf = date('d/m/Y', strtotime($dates[2]));
                    }
                    
                    // Afficher les dates
                    if (isset($dates[0])) {
                    echo "
                        <li class=\"nav-item\" role=\"presentation\">
                            <a class=\"nav-link active\" id=\"ex1-tab-1\" data-toggle=\"pill\" href=\"#$date1nf\" role=\"tab\" aria-selected=\"true\">$date1</a>
                        </li>
                    ";}

                    if (isset($dates[1])) {
                    echo "
                        <li class=\"nav-item\" role=\"presentation\">
                            <a class=\"nav-link\" id=\"ex1-tab-2\" data-toggle=\"pill\" href=\"#$date2nf\" role=\"tab\" aria-selected=\"false\">$date2</a>
                        </li>
                    ";}
                    if (isset($dates[2])) {
                    echo "
                        <li class=\"nav-item\" role=\"presentation\">
                            <a class=\"nav-link\" id=\"ex1-tab-3\" data-toggle=\"pill\" href=\"#$date3nf\" role=\"tab\" aria-selected=\"false\">$date3</a>
                        </li>
                    ";}

                } else {
                    echo "<br>";
                    echo "<h2 style=\"color: red; margin-top: 30px;\">Aucune date trouvée pour cet évènement.</h2>";
                }
            ?>                   
                </ul>
            </div>
            
            <?php
    // Inclure le fichier de configuration de la base de données
    include('includes/db.php');

    // Requête pour récupérer les informations de l'événement depuis la base de données
    if(isset($_GET['id']) && !empty($_GET['id'])){
    $query = "SELECT id, nom, prenom, profession, titre, description, date, heure_debut, heure_fin FROM evenement WHERE id_cours={$_GET['id']} ORDER BY date, heure_debut";
    }else{
    $query = "SELECT id, nom, prenom, profession, titre, description, date, heure_debut, heure_fin FROM evenement ORDER BY date, heure_debut";
    }
    $result = $bdd->query($query);

    // Vérifier s'il y a des résultats
    if ($result->rowCount() > 0) {
        // Initialiser la date précédente
        $previous_date = null;
        $compteurbis= 0;
        // Parcourir les résultats
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Récupérer les données de l'événement
            $id = $row['id'];
            $date = $row['date'];
            $heure_debut = $row['heure_debut'];
            $heure_fin = $row['heure_fin'];
            $titre = $row['titre'];
            $description = $row['description'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $profession = $row['profession'];
            $heure_debut_formattee = date('H:i', strtotime($heure_debut));
            $heure_fin_formattee = date('H:i', strtotime($heure_fin));
            $date_formattee = date('d/m/Y', strtotime($date));
            // Vérifier si la date actuelle est différente de la date précédente
            $compteur = 1;
            
            if ($date != $previous_date) {
                // Si oui, commencer une nouvelle ligne
                if ($previous_date !== null) {
                    echo '</div>'; // Fermer la div row si ce n'est pas la première ligne
                }
                echo '<div class="tab-content" id="ex1-content">';
                echo '<div class="tab-pane fade active show" id="ex1-tabs-'.$compteur.'" role="tabpanel">';
                echo '<div class="row">';
                $compteur++;
            }

            echo '
            <div class="col-lg-4 col-md-6"id="'.$date_formattee.'">
                <div class="single-schedules-inner">
                    <div class="date" '; if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif'){ echo' style="color:black;"';} echo' >
                        <i class="fa fa-clock-o" id="' . $date_formattee . '"></i>
                        ' . $heure_debut_formattee . " - " . $heure_fin_formattee . "&emsp;" . $date_formattee . '
                    </div>
                    <h5'; if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif'){ echo' style="color:black;"';} echo'>' . $titre . '</h5>
                    <p'; if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif'){ echo' style="color:black;"';} echo'>' . $description . '</p>
                    <div class="media">
                        <div class="media-body align-self-center">
                            <h6'; if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif'){ echo' style="color:black;"';} echo'>' . $prenom . ' ' . $nom . '</h6>
                            <p'; if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif'){ echo' style="color:black;"';} echo'>' . $profession . '</p>
                        </div>
                        <div class="media-left">';
                        $resa_query = "SELECT id_user, id_evenement FROM reserve WHERE id_user = :id_user && id_evenement = :id_evenement";
                        $stmt = $bdd->prepare($resa_query);
                        $stmt->execute(['id_user' => $_SESSION['id'],'id_evenement' => $id]);
                        $user_resa = $stmt->fetch(PDO::FETCH_ASSOC);
                            if(isset($user_resa) && !empty($user_resa)){
                            echo '<button type="button" class="btn btn-primary" data-mdb-ripple-init onclick="payement'.$compteurbis.'()" style="background-color : grey; border-color: grey;" disabled >Réservation</button>
                                  <button type="button" class="btn btn-danger" data-mdb-ripple-init onclick="unevent'.$compteurbis.'()" >Désinscription</button>';
                            }else{
                            echo '<button type="button" class="btn btn-primary" data-mdb-ripple-init onclick="payement'.$compteurbis.'()" >Réservation</button>';
                            }
                            echo '
                            <script>
                                function payement'.$compteurbis.'() {
                                    window.location.href = "payement.php?id='.$id.'";
                                }
                            </script>
                            <script>
                                function unevent'.$compteurbis.'() {
                                    window.location.href = "payement.php?id='.$id.'&alert=1";
                                }
                            </script>';
                            if ($_SESSION['verif_f'] == 2 || $_SESSION['email'] == 'admin@guepstar.com') {
                            echo '
                            <button type="button" class="btn btn-danger" data-mdb-ripple-init onclick="supprimer'.$compteurbis.'()">Supprimer</button>
                            <script>
                                function supprimer'.$compteurbis.'() {
                                    window.location.href = "suppression_resa.php?id='.$id.'";
                                }
                            </script>';
                            }
                            echo '
                        </div>
                    </div>
                </div>
            </div>';


            // Mettre à jour la date précédente
            $previous_date = $date;
            $compteurbis++;
        }
        // Fermer la dernière ligne
        echo '</div>'; // Fermer la div row
        echo '</div>'; // Fermer la div tab-pane
        echo '</div>'; // Fermer la div tab-content
    }
?>


<!--
                <div class="tab-pane fade active show" id="ex1-tabs-2" role="tabpanel">
                    <div class="row">

                        <div class="col-lg-4 col-md-6">
                            <div class="single-schedules-inner">
                                <div class="date">
                                    <i class="fa fa-clock-o"></i>
                                    5:00pm - 6:30pm
                                </div>
                                <h5>ez aent.</h5>
                                <p>Lorem  ezcvEEEEEEEEEEEEEEEEEEEEEEEE labore et dolore magna aliquyam erat, sed diam voluptua</p>
                                <div class="media">
                                    <div class="media-body align-self-center">
                                        <h6>Dr. Ariful Islam Abid</h6>
                                        <p>Ceo of AIA software agency, USA.</p>
                                    </div>
                                    <div class="media-left">
                                    <button type="button" class="btn btn-primary" data-mdb-ripple-init onclick="payement()">Réservation</button>
                                    <script>
                                        function payement() {
                                            window.location.href = "payement.php";
                                        }
                                    </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>-->
            </div>
        </div>

    <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-title text-center">
                        <h1>Lieu du cours :</h1>
                        <br><p>242 Rue du Faubourd Saint-Antoine, 75012 Paris, France</p>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
    <div class="ratio ratio-21x9">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.2775760830753!2d2.3824539!3d48.8490961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6720d9c7af387%3A0x5891d8d62e8535c7!2sYour%20Location%20Name!5e0!3m2!1sen!2sus!4v1672242259543!5m2!1sen!2sus"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
        </main>

        <?php include('includes/footer.php'); ?>
    </body>

</html>