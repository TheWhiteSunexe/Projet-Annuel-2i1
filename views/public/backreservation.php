<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['email'] != 'administrateur@guepstar.com') {
    header('location: index.php');
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
        echo '<link rel="stylesheet" type="text/css" href="css/style_reservation.css">';
    } else {
        echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
        echo '<link rel="stylesheet" type="text/css" href="css/style_reservation.css">';
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

        <div class="payement">
                <div class="card mt-50 mb-50">
                    <div class="card-title mx-auto">
                        Réservation d'un évènement
                    </div>
                    <div role="alert">
                                <?php include('includes/message.php'); ?>
                    </div>
                    <?php
                    if(isset($_GET['id']) && !empty($_GET['id'])){
                        echo'<form action="verif_resa.php?id='.$_GET['id'].'" method="post">';
                    }else{
                        echo'<form action="verif_resa.php" method="post">';
                    }
                    ?>
                    <form action="verif_resa.php" method="post">
                        <div class="row-1">
                            <div class="row row-2">
                                <span id="card-inner">Nom</span>
                            </div>
                            <div class="row row-2">
                                <input type="text" name="nom" placeholder="Nom">
                            </div>
                        </div>
                        <div class="row-1">
                            <div class="row row-2">
                                <span id="card-inner">Prénom</span>
                            </div>
                            <div class="row row-2">
                                <input type="text" name="prenom" placeholder="Prénom">
                            </div>
                        </div>
                        <div class="row-1">
                            <div class="row row-2">
                                <span id="card-inner">Profession</span>
                            </div>
                            <div class="row row-2">
                                <input type="text" name="profession" placeholder="Profession">
                            </div>
                        </div>
                        <div class="row-1">
                            <div class="row row-2">
                                <span id="card-inner">Titre de l'évènement</span>
                            </div>
                            <div class="row row-2">
                                <input type="text" name="titre" placeholder="Titre">
                            </div>
                        </div>
                        <div class="row-1">
                            <div class="row row-2">
                                <span id="card-inner">Description de l'évènement</span>
                            </div>
                            <div class="row row-2">
                                <input type="text" name="description" placeholder="Description">
                            </div>
                        </div>
                        <div class="row three">
                            <div class="col-7">
                                <div class="row-1">
                                    <div class="row row-2">
                                        <span id="card-inner">Date de l'évènement</span>
                                    </div>
                                    <div class="row row-2">
                                    <input type="date" name="date" placeholder="Date de l'évènement" min="2024-04">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                            <div class="row row-2">
                                        <span id="card-inner">Heure de début :</span>
                                    </div>
                                <div class="row row-2">
                                <input type="time" id="heure_debut" name="heure_debut">
                            </div>
                            <div class="row row-2">
                                        <span id="card-inner">Heure de fin :</span>
                                    </div>
                                <div class="row row-2">
                                <input type="time" id="heure_fin" name="heure_fin">
                            </div>
                            </div>
                        </div>
                        <button class="btn d-flex mx-auto" type="submit"><b>Ajouter l'évènement</b></button>
                    </form>
                </div>
            </div>
        </main>

        <?php include('includes/footer.php'); ?>
    </body>

</html>